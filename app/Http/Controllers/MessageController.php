<?php

namespace App\Http\Controllers;

use App\Events\ChatMessageReceived;
use App\Models\Contact;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
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
        $user = User::where(['api_key' => $request->get('api_key')])->first();
        Log::info($user);
        $contact = Contact::firstOrNew(['phone' => $request->get('phone'), 'user_id' => $user->id]);
        if ($request->has('name') && (!$contact->name || $request->name != $contact->name)) $contact->name = $request->get('name');
        $contact->save();

        $occurred_at = $request->has('occurred_at') ? Carbon::parse(str_replace(" at ", " ", $request->get('occurred_at'))) : Carbon::now();

        Message::create([
            'contact_id' => $contact->id,
            'text' => $request->get('text'),
            'my_message' => $request->get('my_message') ?? false,
            'occurred_at' => $occurred_at
        ]);

        return response()->json(['status' => 'success']);
    }

    public function send(Request $request)
    {
        $client = new Client;
        $event = 'sms_received';
        $url = "https://maker.ifttt.com/trigger/{$event}/with/key/emgH7lOiSeV4j-oTt2Yupu-NkQR_mTPN4yBxITXs9UT";
        $client->post($url, [RequestOptions::JSON => [
            'value1' => $request->phone,
            'value2' => $request->text
        ]]);
    }
}
