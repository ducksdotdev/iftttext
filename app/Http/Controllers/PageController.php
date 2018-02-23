<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Message;
use JavaScript;

class PageController extends Controller
{
    public function index()
    {
        JavaScript::put([
            'messages' => Message::all(),
            'contacts' => Contact::all()
        ]);
        return view('chat');
    }
}
