<?php

namespace App\Http\Controllers;

use App\Events\ChatMessageReceived;
use App\Models\Contact;
use App\Models\Message;
use Illuminate\Filesystem\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class MessageController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function receive(Request $request)
    {
        $contact = Contact::firstOrNew(['phone' => $request->get('phone')]);
        if ($request->has('name')) $contact->name = $request->get('name');
        $contact->save();

        Message::create([
            'contact_id' => $contact->id,
            'text' => $request->get('text')
        ]);

        return response()->json(['status' => 'success']);
    }
}
