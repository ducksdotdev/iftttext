<?php

namespace App\Http\Controllers;

use App\Events\ChatMessageReceived;
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
    public function post(Request $request)
    {
        $message = new Message($request->all());
        event(new ChatMessageReceived($message));
        return response()->json(['status' => 'success']);
    }

    public function cachePush(Message $message)
    {
        $collection = Cache::tags(['messages'])->get($message->getData()->number);
        $collection->push($message);
        Cache::tags('messages')->put($message->getData()->number, $message);
    }

    public function get($number)
    {
        return Cache::tags('messages')->get($number)->toJson();
    }
}
