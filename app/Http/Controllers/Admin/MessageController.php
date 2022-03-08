<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    public function index() {
        $messages = Message::all();
        return view('admin.messages.index', compact('messages'));
    }
}
