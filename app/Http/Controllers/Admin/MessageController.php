<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Message;
class MessageController extends Controller
{
    public function index($id) {
        $apartment_id = Apartment::find($id);
        $messages = Message::where('apartment_id', '=', $id)->get();

        return view('admin.messages.index', compact('messages', 'apartment_id'));
    }
}
