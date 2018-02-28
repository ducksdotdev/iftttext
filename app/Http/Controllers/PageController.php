<?php

namespace App\Http\Controllers;

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
