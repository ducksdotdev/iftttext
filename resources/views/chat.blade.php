@extends('layouts.app')

@section('content')
    <contact-list :active="active"></contact-list>
    <div class="chat" v-if="active">
        <contact :contact="active"></contact>
        <message-history :messages="messages"></message-history>
        @include ('partials.message-form');
    </div>
@endsection