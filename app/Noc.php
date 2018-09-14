<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Noc extends Model
{
    use SoftDeletes;
    protected $table = 'noc';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];
}
