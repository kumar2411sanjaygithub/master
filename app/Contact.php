<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Contact extends Model
{
    use SoftDeletes;
    protected $table = 'contact';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];
}
