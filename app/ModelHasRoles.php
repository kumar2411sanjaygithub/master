<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
class ModelHasRoles extends Model
{
    //use SoftDeletes;
    protected $table = 'model_has_roles';
    public $fillable = ['*'];
    public $timestamps = false;

    //protected $dates = ['deleted_at'];

}
?>