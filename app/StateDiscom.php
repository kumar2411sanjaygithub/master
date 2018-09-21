<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class StateDiscom extends Model
{
    use SoftDeletes;
    protected $table = 'tbl_state_discom_sldc';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];
}
?>