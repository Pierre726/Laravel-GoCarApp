<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
