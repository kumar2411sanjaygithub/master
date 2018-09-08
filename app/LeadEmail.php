<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class LeadEmail extends Model
{
  use SoftDeletes;
    protected $table = 'lead_email';
    public $fillable = ['*'];
    protected $dates = ['deleted_at'];
}
?>