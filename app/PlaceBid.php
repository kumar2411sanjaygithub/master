<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PlaceBid extends Model
{
    use SoftDeletes;
    protected $table = 'place_bid';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];


     public function client()
    {
        return $this->belongsTo('App\Client','client_id','id');
    }
}
