<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SignupRequest extends Model{
    protected $fillable = ['email', 'password', 'first_name', 'last_name', 'status'];
    protected $casts = ["status" => "string"];
}
