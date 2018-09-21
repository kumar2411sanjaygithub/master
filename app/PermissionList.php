<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PermissionList extends Model
{
  use SoftDeletes;
    protected $table = 'tbl_permissions';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];
}
?>