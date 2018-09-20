<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ExcExchangeRatio extends Model
{
	use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'rec_exchange_ratio';

    public $fillable = ['*'];

}
