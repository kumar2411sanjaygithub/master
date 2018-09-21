<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Approvalrequest extends Model
{
    protected $table = 'approval_request';

    public $fillable = ['id', 'client_id', 'attribute_name', 'updated_attribute_value', 'approval_type', 'old_att_value', 'updated_by'];


  //   public function client_approval(){
  //   	return $this->hasMany('App\Clientmaster', 'id', 'client_id');
  //   }
  //   public function client(){
  //   	 $client = $this->client_approval()->select('company_name','crn_no')->orderBy('id','desc')->take(1)->get()->toArray();
    	 
  //    if(count($client)>0){
       
  //    	$array = array($client[0]['company_name'],$client[0]['crn_no']);

  //      return $array;
  //    }
    
  //    return 'NA';
  //   }

  //   /** for auth _id**/
  //    public function creator(){
  //       return $this->hasOne('App\User','id','updated_by');

  //   }

  //   public function creator_name(){
  //       if($this->creator()->count() > 0)
  //       {
          
  //           return strtoupper($this->creator()->select('name')->get()->toArray()['0']['name']);
            
  //       }
    
  //       return '';
  //   }
  //   public function save(array $options = array()) { 
  //       if(!$this->updated_by) {
  //          $this->updated_by = \Auth::id(); 
  //      // $this->added_by = 2; 
  //   } 
  //   parent::save($options); 
  // }
}
