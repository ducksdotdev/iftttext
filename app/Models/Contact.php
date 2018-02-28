<?php

namespace App\Models;

use App\Events\ContactCreated;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'phone', 'user_id'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            event(new ContactCreated($model->toArray()));
        });
    }
}
