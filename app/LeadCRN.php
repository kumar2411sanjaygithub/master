<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class LeadCRN extends Model
{
    use SoftDeletes;
    protected $table = 'tbl_lead_crn_info';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];
}
?>