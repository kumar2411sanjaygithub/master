<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScheduleLosses extends Model
{
   protected $table = 'exc_temporary_iex_losses';

    public $fillable = ['*'];

}
