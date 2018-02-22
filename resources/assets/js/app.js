import bus from "./bus";
import ContactList from "./components/ContactList";

window.Vue = require('vue');
Vue.use(require('vue-resource'));

const socket_port = 3000;
const socket_host = 'http://127.0.0.1';
const socket = io(socket_host + ":" + socket_port);

const app = new Vue({
  el: '#app',
  components: {ContactList},
  data: {
    message: '',
    active: null,
    messages: [],
    messageHistory: BladeData.messages,
  },
  mounted() {
    bus.$on('active', this.setActive);
    this.$nextTick(function () {
      socket.on('private-chat-channel', function (event) {
        const data = event.data;
        if (this.active && this.active.id === this.data.contact_id) {
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
        number: this.active.number,
        _token: this._token
      });
      this.message = '';
    },
    setActive(contact) {
      this.active = contact;
    }
  }
});