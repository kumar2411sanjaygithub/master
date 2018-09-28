<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillCycle extends Model
{
    protected $table = 'bill_cycle_setting';
    public $fillable = ['*'];

    public function client_details() {
        return $this->belongsTo('App\Client', 'client_id', 'id');
    }
   
    // public function userclient(){
    //    $client = $this->client_details()->select('company_name')->get()->toArray();
      
    //  if(count($client)>0){
 
    //    return $client ;
    //  }
    //  return $client ;
    // }
}
