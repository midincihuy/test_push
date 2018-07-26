<?php

use Illuminate\Database\Seeder;
use App\Scheduler;

class SchedulerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr_data = [
	        [
	        	'command' => 'check:tunnel',
	            'cron_expression' => '* * * * *',
	        ]
	    ];

	    foreach($arr_data as $data){
	        Scheduler::create([
	        	'command' => $data['command'],
	            'cron_expression' => $data['cron_expression'],
	        ]);
	    }
    }
}
