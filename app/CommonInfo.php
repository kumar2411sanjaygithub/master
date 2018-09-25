<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CommonInfo extends Model
{
    use SoftDeletes;
    protected $table = 'commoninfo';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];
}
