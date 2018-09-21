<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Industry extends Model
{
    use SoftDeletes;
    protected $table = 'tbl_industry';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];
}
?>