import bus from "./bus";
import Contact from "./components/Contact";
import ContactList from "./components/ContactList";
import MessageHistory from "./components/MessageHistory";

window.Vue = require('vue');
Vue.use(require('vue-resource'));

if ('serviceWorker' in navigator && 'PushManager' in window) {
  console.log('Service Worker and Push is supported');
  navigator.serviceWorker.register('js/sw.js')
    .then(function (swReg) {
      console.log('Service Worker is registered', swReg);
    })
    .catch(function (error) {
      console.error('Service Worker Error', error);
    });
} else {
  console.warn('Push messaging is not supported');
}

const app = new Vue({
  el: '#app',
  components: {ContactList, Contact, MessageHistory},
  data: {
    active: null,
  },
  mounted() {
    bus.$on('active', this.setActive);
  },
  methods: {
    setActive(contact) {
      this.active = contact;
    },
  }
});