<?php
namespace tptcl\iex;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Tasknew extends Model
{
    use SoftDeletes;
    protected $table = 'tbl_permissions';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];

//  For dammin Model data
}
?>