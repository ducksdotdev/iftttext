<?php

namespace App\Models;

use App\Events\ContactCreated;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'phone'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            event(new ContactCreated($model->toArray()));
        });
    }
}