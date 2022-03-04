<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index() {
        $services = Service::all();
        foreach ($services as $service ) {
            if ($service->icon) {
                $service->icon = url('storage/' . $service->icon);
            }
        }
        return response()->json($services); 
    }  
}
