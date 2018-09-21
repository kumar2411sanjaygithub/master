<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BankTemp extends Model
{
    use SoftDeletes;
    protected $table = 'bank_temp';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];
}
?>