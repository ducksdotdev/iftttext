<template>
  <div>
    <div class="history">
      <message v-for="(message, index) in messages" :key="index" :message="message"></message>
    </div>
    <form class="chat-message" v-on:submit.prevent="send">
      <textarea v-model="message" placeholder="Type your message" v-on:keypress.enter.prevent="send"></textarea>
      <i class="fa fa-file-o"></i><i class="fa fa-file-image-o"></i>
      <button>Send</button>
    </form>
  </div>
</template>

<script>
  import Message from "./Message";
  import moment from "moment";

  const socket_port = 3000;
  const socket_host = 'http://127.0.0.1';
  const socket = io(socket_host + ":" + socket_port);

  export default {
    components: {Message},
    props: {
      active: {
        type: Object,
        required: true
      }
    },
    data: function () {
      return {
        messageHistory: BladeData.messages,
        message: ''
      }
    },
    methods: {
      send: function () {
        if (this.message.length > 0) {
          let message = {
            text: this.message,
            phone: this.active.phone
          };
          this.$http.post('/api/send', message);
          message = Object.assign(message, {
            contact_id: this.active.id,
            my_message: true,
            temp: true,
            occurred_at: moment().format()
          });
          this.messageHistory.push(message);
          this.$nextTick(function () {
            let container = document.getElementsByClassName("history")[0];
            container.scrollTop = container.scrollHeight;
          });
        }
        this.message = '';
      },
    },
    mounted() {
      this.$nextTick(function () {
        socket.on('private-chat-channel', function (event) {
          const data = event.data;
          this.messageHistory.push(data);
          this.messageHistory = this.messageHistory.filter(function (message) {
            return !(message.temp && message.text === data.text && message.contact_id === data.contact_id);
          });

          if (this.active && this.active.id === data.contact_id) {
            this.$nextTick(function () {
              let container = document.getElementsByClassName("history")[0];
              container.scrollTop = container.scrollHeight;
            });
          }
        }.bind(this));
        socket.on('private-contact-channel', function (event) {
          const contact = event.contact;
          bus.$emit('newContact', contact);
        }.bind(this));
      });
    },
    computed: {
      messages: function () {
        return this.messageHistory.filter(function (message) {
          return message.contact_id === this.active.id;
        }.bind(this))
          .sort(function (a, b) {
            return moment(a.occurred_at).diff(b.occurred_at);
          });
      }
    }
  }
</script>