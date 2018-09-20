<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ContactTemp extends Model
{
    use SoftDeletes;
    protected $table = 'contact_temp';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];
}
