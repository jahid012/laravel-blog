<?php

namespace App\Rules;

use \Exception;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DBCheckConnection implements Rule
{
    /**
     * @var $request
     */
    public $data;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data = request()->except('_token');
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $settings = config("database.connections.{$value}");
        config(["database.default" => 'sqlite']);
        config(["database.connections.sqlite.database" => database_path('database.sqlite')]);

        if($value != 'sqlite'){
            config([
                'database' => [
                    'default' => $value,
                    'connections' => [
                        "{$value}" => array_merge($settings, [
                            'driver'    => $value,
                            'host'      => $this->data['DB_HOST'],
                            'port'      => $this->data['DB_PORT'],
                            'database'  => $this->data['DB_DATABASE'],
                            'username'  => $this->data['DB_USERNAME'],
                            'password'  => $this->data['DB_PASSWORD'],
                        ]),
                    ],
                ],
            ]);
        }

        try {
            DB::purge();
            DB::connection()->getPdo();
            return true;
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Connection to your database cannot be established. Please provide correct database credentials.';
    }
}
