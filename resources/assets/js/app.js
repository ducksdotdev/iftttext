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
        this.messageHistory.push(data);
        if (this.active && this.active.id === data.contact_id) {
          this.messages.push(data);
          this.$nextTick(function () {
            const container = this.$el.querySelector(".chat-history");
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
  methods: {
    send: function () {
      this.$http.post('/api/send', {
        text: this.message,
        phone: this.active.phone
      });
      this.message = '';
    },
    setActive(contact) {
      this.active = contact;
      this.messages = this.messageHistory.filter(function (message) {
        return message.contact_id === contact.id;
      });
    }
  }
});