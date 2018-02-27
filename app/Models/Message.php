<?php

namespace App\Models;

use App\Events\ChatMessageReceived;
use Bnb\PushNotifications\Notification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Message extends Model
{
    protected $fillable = ['text', 'contact_id', 'my_message', 'occurred_at'];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {

            event(new ChatMessageReceived([
                'contact_id' => $model->contact_id,
                'text' => $model->text,
                'my_message' => $model->my_message,
                'occurred_at' => $model->occurred_at->toDateTimeString()
            ]));
        });
    }

}