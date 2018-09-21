<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Servise extends Model
{
    use SoftDeletes;
    protected $table = 'service';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];
}
