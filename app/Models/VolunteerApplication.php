<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VolunteerApplication extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'role', 'message', 'status'];
}
