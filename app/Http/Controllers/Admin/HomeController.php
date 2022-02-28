<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Apartment;

class HomeController extends Controller
{
    public function index() {

        $current_id = Auth::id();
        $apartments = Apartment::where('user_id', '=', $current_id)->get();

        return view('admin.home', compact('apartments'));
    }
}
