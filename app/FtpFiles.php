<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FtpFiles extends Model
{
    //
    protected $table = 'ftp_file_status';

    protected $primary_key ='id';
    public $fillable = ['date', 'client_id', 'portfolio_id', 'filename', 'filepath', 'type', 'status', 'entry_by', 'created_at', 'updated_at'];


    public function user(){
    	return $this->hasMany('App\Client', 'id', 'client_id');
    } 
    public function userclient(){
    	 $client = $this->user()->select('company_name')->orderBy('id','desc')->take(1)->get()->toArray();
    	 //dd($this->user());
     if(count($client)>0){
       return $client[0]['company_name'] ;
     }
     // return $this->portfolio_id;
    }
    public function oblDetails(){
        return $this->hasMany('App\Obligation','portfolio_id','portfolio_id');
    }
    public function ScheduleDetails(){
       return $this->hasMany('App\ScheduleLosses','portfolioid','portfolio_id'); 
    }
}
