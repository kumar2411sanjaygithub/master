<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models;
//use Illuminate\Database\Eloquent\SoftDeletes;
class Role extends Model
{
    //use SoftDeletes;
    protected $table = 'roles';
    public $fillable = ['*'];
    //protected $dates = ['deleted_at'];
    public $timestamps = false;
    
    public function getDepartment()
    {
        return $this->belongsTo('App\Department','department_id','id');
    }
    public function getuser()
    {
        return $this->belongsTo('App\User','created_by','id');
    }    
}
?>