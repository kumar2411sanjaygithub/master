<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class NocApp extends Model
{
  	use SoftDeletes;
    protected $table = 'tbl_noc_application';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];

    public function client()
    {
        return $this->belongsTo('App\Client','client_id','id');
    }

}
?>