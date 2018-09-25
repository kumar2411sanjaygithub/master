<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Validationsetting extends Model
{
    protected $table = 'validationsetting';

    public $fillable = ['*'];

    public function clients(){
        return $this->belongsTo('App\Client','user_id','id');
    }
}
