<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    protected $table = 'invoice';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];

    
    
    public function getCustomerDetails(){
    	return $this->hasOne('App\Client','invoice_id','id');
    }
    public function invoiceDescription(){
    	return $this->hasMany('App\BillDetails','id','id');
    }
        public function getPreAmount()
    {
        $amount = $this->cost * $this->qty;
        return $amount;
    }
    public function getTaxAmount(){
        $tax = 0;
        $preTaxAmount = $this->getPreAmount();
        if ($this->tax_rate1) {
            $tax += round($preTaxAmount * $this->tax_rate1 / 100, 2);
        }
        if ($this->tax_rate2) {
            $tax += round($preTaxAmount * $this->tax_rate2 / 100, 2);
        }
        return $tax;
    }
    public function totalAmount() {
        return $this->getPreAmount() + $this->getTaxAmount();
    }
    public function formatSetting(){
    	
    }
    public function financialYear(){
        return $year = ( date('m') > 3) ? date('Y') + 1 : date('Y');
    }

    public function checker(){
        $this->check = '1';
        $this->checker = \Auth::guard('user')->id();
        $this->save();
    }
     public function approver(){
        $this->approve = '2';
        $this->approver = \Auth::guard('user')->id();
        $this->save();
    }
    public function reject(){
        $this->reject = '3';
        $this->checker || $this->approver = \Auth::guard('user')->id();
        $this->save();
    }
}
