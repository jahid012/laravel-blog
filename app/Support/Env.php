<?php
namespace App\Support;

class Env{

    /**
     * .Env lines
     * @var
     */
    public array $lines = [];

    /**
     * .Env data
     * @var
     */
    public array $data = [];

    /**
     * The constructor.
     */
    public function __construct( )
    {
        // init line
        if(empty($this->lines)){
            $content = file_get_contents(base_path('.env'));
            $this->lines = explode(PHP_EOL, $content);
        }

        // init data
        if(empty($this->data)){
            foreach ($this->lines as $line) {
                $this->data[] = $this->makeData($line);
            }
        }
    }

    /**
     * Line as .env data filter
     *
     * @param string $data
     * @return array
     */
    private function makeData(string $original_line): Array
    {
        // enabled is comment of line
        $enabled = true;
        $line    = $original_line;

        if(substr($line, 0, 1) == '#'){
            $dataArray = explode("#", $line);
            unset($dataArray[0]);
            $line = implode('#', $dataArray);
            $enabled = false;
        }

        //type = line, .env
        $new = array(
            'type'          => 'line',
            'original_line' => $original_line,
            'line'          => $line,
            'key'           => null,
            'value'         => null,
            'enabled'       => $enabled,
        );

        // is env valid data check
        if(strpos($line, '=')){
            $envData    = explode('=', $line);
            $key        = str_replace(' ', '', trim($envData[0]));
            $value      = "";

            // get value with other stirng or data
            if(isset($envData[1]) == true){
                unset($envData[0]);
                $value  = implode('=', $envData);
            }

            // make .env data
            $new['key']     = $key;
            $new['value']   = $value;
            $new['type']    = 'env';
        }

        return $new;
    }

    /**
     * Add env data
     * @param string $key
     * @param string $value
     * @return bool
     */
    public function create($keys, string $value = ""): bool
    {
        if(is_array($keys)){
            foreach ($keys as $key => $v) {
                if(!is_string($v)){
                    $v = "";
                }

                if(is_string($key)){
                    $this->create($key, $v);
                }
            }
        }
        if(!is_string($keys) || $this->has((string)$keys)){
            return false;
        }

        $this->data [] = array(
            'type'          => 'env',
            'original_line' => "{$keys}={$value}",
            'line'          => "{$keys}={$value}",
            'key'           => $keys,
            'value'         => $value,
            'enabled'       => 'true',
        );

        $this->makeLines();

        return $this->save();
    }

    /**
     * Has key
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        foreach ($this->data as $value) {
            if(isset($value['type']) == true && $value['type'] == 'env' && $key == $value['key']){
                return true;
            }
        }
        return false;
    }

    /**
     * Update env data
     * @param string|array $keys
     * @param string $value
     * @return bool
     */
    public function update($keys, string $value = "")
    {
        if(is_array($keys)){
            foreach ($keys as $key => $v) {
                if(is_string($key)){
                    $this->update($key, (string)$v);
                }else{
                    return false;
                }
            }
        }
        if(!is_string($keys) || !$this->has((string)$keys)){
            return false;
        }
        foreach ($this->data as $key => $v) {

            if( isset($v['key']) == true && $v['key'] == $keys){
                $this->data[$key] = array(
                    "type"          => "env",
                    "original_line" => "{$keys}={$value}",
                    "line"          => "{$keys}={$value}",
                    "key"           => "{$keys}",
                    "value"         => "{$value}",
                    "enabled"       => true
                );
                $this->makeLines();
                return $this->save();
            }
        }
        return false;
    }

    /**
     * Update env data
     * @param string|array $keys
     * @param string $value
     * @return bool
     */
    public function updateOrCreate($keys, string $value = "")
    {
        if(is_array($keys)){
            foreach ($keys as $key => $v) {
                if(is_string($key)){
                    return $this->updateOrCreate($key, $v);
                }
            }
            return false;
        }

        // check keys and values
        if(!is_string($keys) && !is_string($value)){
            return false;
        }

        // oparations
        if($this->has((string)$keys)){
            return $this->update($keys, (string)$value);
        }else{
            return $this->create($keys,  (string)$value);
        }
        return false;
    }


    /**
     * Remove env data
     * @param array|string $keys
     * @return bool
     */
    public function destroy($keys)
    {
        // mailty data handle
        if(is_array($keys)){
            foreach ($keys as $key) {
                if(is_string($key)){
                    $this->destroy($key);
                }
            }
        }

        // oparation
        if(is_string($keys)){
            foreach ( $this->data as $key => $value) {
                if( isset($value['key']) && $value['key'] == $keys){

                    $this->data[$key] = array(
                        "type"          => "line",
                        "original_line" => "",
                        "line"          => "",
                        "key"           => null,
                        "value"         => null,
                        "enabled"       => false
                    );

                    # ensure all remove lines
                    if($this->has($value['key'])){
                        $this->destroy( $value['key'] );
                    }

                    // make lines
                    $this->makeLines();

                    // update content
                    return $this->save();
                }
            }
        }
        return true;
    }

    /**
     * Make lines
     * @return Env
     */
    public function makeLines()
    {
        $lines = [];
        foreach ($this->data as $value) {

            // start line
            $line = '';
            if($value['enabled'] == false){

                if($value['type'] == 'line' && strlen($value['line']) > 1){
                    $line = '#';
                }
                // plain line
                $lines[] = $line . $value['line'];
            }else{
                $lines[] = $value['line'];
            }
        }
        $this->lines = $lines;
        return $this;
    }

    /**
     * Remove duplicate data
     * remove comment off data first
     * @return Env
     */
    public function removeDuplicate()
    {
        // get duplicate data
        $enableds = $this->getEnableds();
        foreach ($this->lines as $lkey => $line) {
            if(substr($line, 0, 1) == '#'){
                foreach ($enableds as $key => $value) {
                    if(strpos($line, "{$key}=")){
                        unset($this->lines[$lkey]);
                    }
                }
            }
        }

        return $this;
    }

    /**
     *  Get all enabled
     *
     * @return Env
     */
    public function getEnableds():Array
    {
        $data = [];
        foreach ($this->data as $key => $value) {

            if($value['enabled'] == false){
                continue;
            }

            if($value['key'] == null || $value['key'] == ''){
                continue;
            }
            $data[$value['key']] = $value['value'];
        }
        return $data;
    }

    /**
     *  Get all enabled
     *
     * @return Env
     */
    public function getDisableds() :Array
    {
        $data = [];
        foreach ($this->data as $key => $value) {

            if($value['enabled'] == true){
                continue;
            }

            if($value['type'] == 'line'){
                continue;
            }

            if($value['key'] == null || $value['key'] == ''){
                continue;
            }
            $data[$value['key']] = $value['value'];
        }
        return $data;
    }

    /**
     * Get enable and disabled .env
     * @return array
     */
    public function all() :Array
    {
        return $this->data;
    }

    /**
     * Get Env as plan text
     * @return string
     */
    public function getContent() :String
    {
        return implode(PHP_EOL, $this->lines);
    }

    /**
     * Backup .env file
     * @return void
     */
    public function backup():void
    {
        file_put_contents(
            storage_path('app/env-backup/'. date("Y-m-d-His").'.env') ,
            $this->getContent
        );
    }

    /**
     * Save .env files
     * @return void
     */
    public function save():bool
    {
        // formate .env file content
        $re = array("\n\n\n\n\n\n\n\n", "\n\n\n\n\n\n\n", "\n\n\n\n\n\n", "\n\n\n\n\n", "\n\n\n\n", "\n\n\n");
        $content = str_replace($re, PHP_EOL. PHP_EOL, $this->getContent());

        // save content
        return file_put_contents( base_path('.env'), $content );
    }

}

?>
