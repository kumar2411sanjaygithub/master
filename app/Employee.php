<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Employee extends Model
{
    use SoftDeletes;
    protected $table = 'employee_temp';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];
    public function department()
    {
        return $this->belongsTo('App\Department','department_id','id');
    }
    public function role()
    {
        return $this->hasMany('App\Roleofficial','official_id','id');
    }
    // public function roleofficials()
    // {
    //     return $this->belongsTo('App\Roleofficial','id','official_id');
    // }
    public function creator(){
        return $this->hasOne('App\User','id','added_by');
    }
    public function creator_name(){
        if($this->creator()->count() > 0)
        {
            return strtoupper($this->creator()->select('name')->get()->toArray()['0']['name']);
        }
        return '';
  }
   public function save(array $options = array()) { 
        if(!$this->added_by) {
           $this->added_by = \Auth::id(); 
       // $this->added_by = 2; 
    } 
    parent::save($options); 
  }
}
?>