<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class NocBilling extends Model
{
  use SoftDeletes;
    protected $table = 'tbl_noc_billing_stting';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];
}
?>