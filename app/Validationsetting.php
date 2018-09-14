<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Validationsetting extends Model
{
    protected $table = 'validationsetting';

    public $fillable = ['*'];

    public function client_master(){
        return $this->belongsTo('App\Client','user_id','id');
    }
}
