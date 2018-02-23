<?php

namespace App\Models;

use App\Events\ChatMessageReceived;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Message extends Model
{
    protected $fillable = ['text', 'contact_id', 'my_message'];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            event(new ChatMessageReceived($model->toArray()));
        });
    }

}