<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExchangeTemp extends Model
{
    use SoftDeletes;
    protected $table = 'exchange_temp';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];
}
