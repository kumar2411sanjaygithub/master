<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Lead extends Model
{
    use SoftDeletes;
    protected $table = 'leads';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];

    public function leadowner()
    {
    	return $this->belongsTo('App\User','lead_owner','id');
    }
    public function leadsource()
    {
    	return $this->belongsTo('App\LeadSource','lead_source','id');
    }
}
?>