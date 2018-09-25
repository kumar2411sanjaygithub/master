<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillCycle extends Model
{
    protected $table = 'bill_cycle_setting';
    public $fillable = ['*'];
}
