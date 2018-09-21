<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Discomdetails extends Model
{
	use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'discom';

    public $fillable = ['*'];

}
