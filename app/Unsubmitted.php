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

    public function Client(){
    	return $this->belongsTo('App\Client','client_id','id');
    }
}
