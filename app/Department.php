<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Department extends Model
{
  use SoftDeletes;
    protected $table = 'department';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];
    // public function role()
    // {
    //     return $this->hasMany('App\Role','department_id', 'id');
    // }
    public function creator(){
        return $this->hasOne('App\User','id','created_by');
    }
    public function creator_name(){
        if($this->creator()->count() > 0)
        {
            return strtoupper($this->creator()->select('name')->get()->toArray()['0']['name']);
        }
        return '';
  }
   public function save(array $options = array()) { 
        if(!$this->created_by) {
           $this->created_by = \Auth::id(); 
       // $this->added_by = 2; 
    } 
    parent::save($options); 
  }
}
?>