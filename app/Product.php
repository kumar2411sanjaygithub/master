<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use SoftDeletes;
    protected $table = 'tbl_product';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];
}
?>