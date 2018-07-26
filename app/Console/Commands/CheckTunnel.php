<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckTunnel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:tunnel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Tunnel and create a new connection';

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
      $commands = "ps -ef | grep amazonaws";
      \SSH::run($commands, function($line){
        $text = "start";
        $connect = false;
        if(strpos($line, 'ssh') !== false){
          $connect = true;
        }
        if(!$connect){
          $this->info("Not connected, Reconnecting");
          \SSH::run('sh tunnel.sh',function($x){
            $this->info($x);
          });
        }else{
          $this->info("Connected");
        }
      });

    }
}
