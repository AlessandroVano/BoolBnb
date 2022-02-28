<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
class HomeController extends Controller
{
    public function index() {
        $apartments = Apartment::all();
        return view('admin.home', compact('apartments'));
    }
}
