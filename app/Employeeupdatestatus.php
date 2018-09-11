<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Employeeupdatestatus extends Model
{
    protected $table = 'employee_update_status';
    public $fillable = ['*'];
    public function user()
    {
        return $this->belongsTo('App\User','employee_id','id');
    }
    public function department()
        {
            return $this->belongsTo('App\Department','department_id','id');
        }
    public function role()
    {
        return $this->hasMany('App\ModelHasRoles','employee_id','id');
    }


  //   public function creator(){
  //       return $this->hasOne('App\User','id','added_by');
  //   }
  //   public function creator_name(){
  //       if($this->creator()->count() > 0)
  //       {
  //           return strtoupper($this->creator()->select('name')->get()->toArray()['0']['name']);
  //       }
  //       return '';
  // }
  //  public function save(array $options = array()) { 
  //       if(!$this->added_by) {
  //          $this->added_by = \Auth::id(); 
  //      // $this->added_by = 2; 
  //   } 
  //   parent::save($options); 
  // }
}
?>
