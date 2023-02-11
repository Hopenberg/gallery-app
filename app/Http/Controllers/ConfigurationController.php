<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfigurationController extends Controller
{
    public function checkIfUserIsLoggedIn() {
        return ['isLoggedIn' => Auth::check()];
    }
}
