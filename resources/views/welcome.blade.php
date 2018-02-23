<!DOCTYPE html>
<html lang="en">
<head>
    <title>IFTTTEXT</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body>
<div class="wrapper" id="app">
    <contact-list :active="active"></contact-list>
    <div class="chat" v-if="active">
        <div class="contact">
            <span class="name">@{{ active.name ? active.name : "Unknown Number"}}</span>
            <span class="phone">@{{ active.phone }}</span>
        </div>
        <div class="history">
            <div class="message" v-for="message in messages" v-bind:class="{'my-message': message.my_message}">
                <div class="time">@{{ message.created_at }}</div>
                <div class="text">
                    @{{ message.text }}
                </div>
            </div>
        </div>
        <form class="chat-message" v-on:submit.prevent="send">
            <textarea v-model="message" placeholder="Type your message" v-on:keypress.enter.prevent="send"></textarea>
            <i class="fa fa-file-o"></i><i class="fa fa-file-image-o"></i>
            <button>Send</button>
        </form>
    </div>
</div>
@include ('data')
<script src="{{ asset('plugins/socket.io/socket.io.min.js') }}"></script>
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
