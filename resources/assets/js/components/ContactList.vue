<template>
  <div class="contact-list">
    <contact v-for="contact in contacts" :contact="contact" v-bind:class="{active: isActive(contact)}" @click="setActive(contact)"/>
  </div>
</template>

<script>
  import Contact from "./Contact";

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
    methods: {
      isActive(contact) {
        return this.active && this.active.id === contact.id;
      }
    }
  }
</script>