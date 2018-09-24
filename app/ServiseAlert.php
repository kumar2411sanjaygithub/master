<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ServiseAlert extends Model
{
    use SoftDeletes;
    protected $table = 'services_alert';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];
}
