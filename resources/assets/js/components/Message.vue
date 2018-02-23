<template>
  <div class="message" v-bind:class="{'my-message': message.my_message}">
    <div class="sending" v-if="message.temp">Sending...</div>
    <div class="time">{{ message.created_at }}</div>
    <div class="text">{{ message.text }}</div>
  </div>
</template>

<script>
  export default {
    props: {
      message: {
        required: true,
        type: Object
      }
    }
  }
</script>