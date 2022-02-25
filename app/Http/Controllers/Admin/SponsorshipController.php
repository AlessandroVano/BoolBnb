<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sponsorship;

class SponsorshipController extends Controller
{
    public function index() {
        $sponsorships = Sponsorship::all();
        return view('admin.sponsorships.index', compact('sponsorships'));
    }
}
