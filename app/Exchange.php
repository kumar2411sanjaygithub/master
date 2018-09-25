<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exchange extends Model
{
    use SoftDeletes;
    protected $table = 'exchange';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];
	
	public function validationsetting(){
      return $this->hasOne('App\Validationsetting',"user_id","client_id");
    }

}
