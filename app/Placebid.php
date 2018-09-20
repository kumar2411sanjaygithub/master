<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Placebid extends Model
{
  use SoftDeletes;

    protected $table = 'place_bid';
    public $fillable = ['*'];

    protected $dates = ['deleted_at'];

    public function clientmaster(){
    	return $this->belongsTo('App\Clientmaster','client_id','id');
    }
}