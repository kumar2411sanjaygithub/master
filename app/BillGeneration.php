<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillGeneration extends Model
{
    protected $table = 'bill_generation';
    public $fillable = ['*'];
}
