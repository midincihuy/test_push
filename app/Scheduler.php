<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scheduler extends Model
{
    protected $fillable = [
    	'command',
        'cron_expression',
  	];
}
