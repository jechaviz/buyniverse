<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helper;

class Notifycontest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:contest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It is to notify the users that the contest is about to get started';

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
     * @return int
     */
    public function handle()
    {
        Helper::notifycontest();
        return 0;
    }
}
