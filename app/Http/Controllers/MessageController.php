<?php

namespace App\Http\Controllers;

use App\Events\ChatMessageReceived;
use App\Models\Contact;
use App\Models\Message;
use GuzzleHttp\Client;
use Illuminate\Filesystem\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

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
            'text' => $request->get('text'),
            'my_message' => $request->get('my_message') ?? false
        ]);

        return response()->json(['status' => 'success']);
    }

    public function send(Request $request)
    {
        $client = new Client;
        $event = 'sms_received';
        $url = "https://maker.ifttt.com/trigger/{$event}/with/key/emgH7lOiSeV4j-oTt2Yupu-NkQR_mTPN4yBxITXs9UT";
        $response = $client->createRequest("POST", $url, ['body' => [
            'value1' => $request->phone,
            'value2' => $request->text
        ]]);
        $response = $client->send($response);
        Log::info($response);
    }
}
