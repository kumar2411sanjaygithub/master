<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class LeadSource extends Model
{
    use SoftDeletes;
    protected $table = 'lead_source';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];
}
?>