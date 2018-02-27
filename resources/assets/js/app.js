import bus from "./bus";
import Contact from "./components/Contact";
import ContactList from "./components/ContactList";
import MessageHistory from "./components/MessageHistory";
import moment from "moment";

window.Vue = require('vue');
Vue.use(require('vue-resource'));

const socket_port = 3000;
const socket_host = 'http://127.0.0.1';
const socket = io(socket_host + ":" + socket_port);

if ('serviceWorker' in navigator && 'PushManager' in window) {
  console.log('Service Worker and Push is supported');
  navigator.serviceWorker.register('js/sw.js')
    .then(function(swReg) {
      console.log('Service Worker is registered', swReg);
    })
    .catch(function(error) {
      console.error('Service Worker Error', error);
    });
} else {
  console.warn('Push messaging is not supported');
}


const app = new Vue({
  el: '#app',
  components: {ContactList, Contact, MessageHistory},
  data: {
    message: '',
    active: null,
    messageHistory: BladeData.messages
  },
  mounted() {
    bus.$on('active', this.setActive);
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
    setActive(contact) {
      this.active = contact;
    },
  }
});