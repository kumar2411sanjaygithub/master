<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Bank extends Model
{
    use SoftDeletes;
    protected $table = 'bank';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];
}
?>