<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class LeadProduct extends Model
{
    use SoftDeletes;
    protected $table = 'lead_product';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];

    public function product_name()
    {
    	return $this->belongsTo('App\Product','product_id','id');
    }

}
?>