<template>
  <div class="contact" @click="setActive">
    <span class="name">{{ contact.name ? contact.name : "Unknown Number"}}</span>
    <span class="phone">{{ contact.phone }}</span>
  </div>
</template>

<script>
  import bus from "../bus"
  export default {
    props: {
      contact: {
        type: Object,
        required: true
      }
    },
    methods: {
      setActive() {
        bus.$emit('active', this.contact);
      }
    }
  }
</script>