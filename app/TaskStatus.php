<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
	protected $table = "tbl_task_status";
	
    protected $fillable = ['*'];

}
