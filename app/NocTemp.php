<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class NocTemp extends Model
{
    use SoftDeletes;
    protected $table = 'noc_temp';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];
}
