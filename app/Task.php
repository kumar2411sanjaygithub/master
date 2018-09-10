<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Task extends Model
{
    use SoftDeletes;
    protected $table = 'tbl_task';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User','owner','id');
    }
}
?>