<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AddUser17 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'adduser17';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add user for open 2017';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = \App\User::all();
        print_r($users);
    }
}
