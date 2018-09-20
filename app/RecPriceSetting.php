<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class RecPriceSetting extends Model
{
  use SoftDeletes;
    protected $table = 'rec_price_setting';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];
}
?>