<?php

namespace App\Console\Commands;

use Dotenv\Dotenv;
use Illuminate\Console\Command;

class EnvCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'env {oparation?} {data?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Env oparation by artisan command';

    public $data = [];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        if(file_exists(base_path('.env'))){
            $this->data = Dotenv::parse(
                file_get_contents(base_path('.env'))
            );
        }
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if($this->argument('oparation') == null){

            return dd($this->data);
            return Command::SUCCESS;
        }

        if(!in_array($this->argument('oparation'), ['add', 'update', 'remove'])){
            $this->error("Invalid: argument. only allow add, update, remove");
            return Command::INVALID;
        }

        if($this->argument('oparation') == 'add'){
            $this->add($this->argument('data'));
        }

        if($this->argument('oparation') == 'update'){
            $this->add($this->argument('data'));
        }

        if($this->argument('oparation') == 'remove'){
            $this->add($this->argument('data'));
        }

        return Command::SUCCESS;
    }

    /**
     *
     */
    public function add($data=[])
    {
        # code...
    }

    /**
     * Have env key
     * @return bool
     */
    public function hasKey($key)
    {
        $data = Dotenv::parse($this->getContent());
        if(isset($data[$key])){
            return true;
        }
        return false;
    }

}
