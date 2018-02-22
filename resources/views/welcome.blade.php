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
<div class="wrapper clearfix" id="app">
    <div class="people-list" id="people-list">
        <ul class="list">
            <li class="clearfix" v-for="person in people">
                <div class="about">
                    <div class="name">@{{ person.name }}</div>
                    <div class="number">@{{ person.number }}</div>
                </div>
            </li>
        </ul>
    </div>
    <div class="chat" v-if="active">
        <div class="chat-header clearfix">
            <div class="chat-about">
                <div class="chat-with">@{{ active.name }} (@{{ active.number }})</div>
            </div>
            <i class="fa fa-star"></i>
        </div>
        <div class="chat-history">
            <ul>
                <li class="clearfix" v-for="message in messages">
                    <div class="message-data align-left">
                        <span class="message-data-time">@{{ message.occurredAt }}</span> <span class="message-data-name">@{{ message.contactName }}</span> <i class="fa fa-circle me"></i>
                    </div>
                    <div class="message other-message float-left">
                        @{{ message.text }}
                    </div>
                </li>
            </ul>
        </div>
        <form class="chat-message clearfix" v-on:submit.prevent="send">
            <textarea v-model="message" placeholder="Type your message" rows="3"></textarea>
            <i class="fa fa-file-o"></i><i class="fa fa-file-image-o"></i>
            <button>Send</button>
        </form>
    </div>
</div>

<script src="{{ asset('plugins/socket.io/socket.io.min.js') }}"></script>
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
