<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillCycleLog extends Model
{
    protected $table = 'bill_cycle_log';
    public $fillable = ['*'];
}
