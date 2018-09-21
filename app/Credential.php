<?php
namespace App;

//namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ClientResetPasswordNotification;
class Credential extends Authenticatable
{
	protected $table = 'credential';
    public $fillable = ['*'];
}