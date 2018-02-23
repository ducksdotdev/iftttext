<template>
  <div class="contact-list">
    <contact v-for="contact in contacts" :contact="contact" v-bind:class="{active: isActive(contact)}" @click="setActive(contact)"/>
  </div>
</template>

<script>
  import Contact from "./Contact";
  import bus from "../bus";

  export default {
    components: {Contact},
    data: function () {
      return {
        contacts: BladeData.contacts,
      }
    },
    props: {
      active: {
        type: Object,
        required: false
      }
    },
    mounted() {
      bus.$on('newContact', this.addContact);
    },
    methods: {
      isActive(contact) {
        return this.active && this.active.id === contact.id;
      },
      addContact(contact) {
        const check = this.contacts.filter(function (item) {
          return item.id === contact.id;
        });
        if (check.length === 0) {
          this.contacts.push(contact);
        }
      }
    }
  }
</script>