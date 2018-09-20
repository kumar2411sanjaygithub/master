<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class RecBiddingSetting extends Model
{
    use SoftDeletes;
    protected $table = 'rec_bidding_setting';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];
}
?>