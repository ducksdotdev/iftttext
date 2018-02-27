<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Message;
use App\Models\User;
use JavaScript;

class PageController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        JavaScript::put([
            'messages' => $user->messages,
            'contacts' => $user->contacts
        ]);
        return view('chat');
    }

    public function settings()
    {
        return view('settings');
    }
}
