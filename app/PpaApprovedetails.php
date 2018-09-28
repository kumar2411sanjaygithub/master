<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PpaApprovedetails extends Model
{
	use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'ppa_details_temp';

    public $fillable = ['*'];
}
