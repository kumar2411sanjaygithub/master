<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obligation extends Model
{
   protected $table = 'iex_obligation_imported';
    public $fillable = ['*'];
}
