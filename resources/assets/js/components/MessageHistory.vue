<template>
  <div class="history">
    <message v-for="(message, index) in messages" :key="index" :message="message"></message>
  </div>
</template>

<script>
  import Message from "./Message";

  export default {
    components: {Message},
    props: {
      messages: {
        required: true,
        type: Array
      }
    }
  }
</script>