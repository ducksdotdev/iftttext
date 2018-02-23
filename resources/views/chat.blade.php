@extends('layouts.app')

@section('content')
    <contact-list :active="active"></contact-list>
    <div class="chat" v-if="active">
        <contact :contact="active"></contact>
        <div class="history">
            <div class="message" v-for="message in messages" v-bind:class="{'my-message': message.my_message}">
                <div class="sending" v-if="message.temp">Sending...</div>
                <div class="time">@{{ message.created_at }}</div>
                <div class="text">@{{ message.text }}</div>
            </div>
        </div>
        <form class="chat-message" v-on:submit.prevent="send">
            <textarea v-model="message" placeholder="Type your message" v-on:keypress.enter.prevent="send"></textarea>
            <i class="fa fa-file-o"></i><i class="fa fa-file-image-o"></i>
            <button>Send</button>
        </form>
    </div>
@endsection