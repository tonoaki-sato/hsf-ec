<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GetMlMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getmlmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get mailing list mail and insert table.';

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
        //
        logger("test-hogehoge\n");
    }
}
