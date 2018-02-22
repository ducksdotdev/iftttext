window.Vue = require('vue');

const socket_port = 3000;
const socket_host = 'http://127.0.0.1';
const socket_channel = 'private-chat-channel';
const socket = io(socket_host + ":" + socket_port);

new Vue({
  el: '#app',
  data: {
    message: '',
    people: [],
    messages: [],
    active: null
  },
  mounted: function () {
    this.$nextTick(function () {
      console.log("Setting socket on " + socket_host + ":" + socket_port + " with channel " + socket_channel + "...");
      socket.on(socket_channel, function (event) {
        const data = event.data;
        console.log(data);
        let contact = {
          name: data.contactName,
          number: data.fromNumber
        };

        let personExists = false;
        this.people.forEach(function (data) {
          if (data.number === contact.number) personExists = true;
        });

        if (!personExists) this.people.push(contact);
        if (!this.active) this.active = contact;
        if (contact.number === this.active.number) {
          this.messages.push(data);
        }

        this.$nextTick(function () {
          const container = this.$el.querySelector(".chat");
          container.scrollTop = container.scrollHeight;
        });
      }.bind(this));
    });
  },
  methods: {
    send: function () {
      this.$http.post('/send', {
        text: this.message,
        _token: this._token
      });
      this.message = '';
    }
  }
});