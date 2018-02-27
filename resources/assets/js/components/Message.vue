<template>
  <div class="message" v-bind:class="{'my-message': message.my_message}">
    <div class="sending" v-if="message.temp">Sending...</div>
    <div class="time">{{ occurred_at }}</div>
    <div class="text">{{ message.text }}</div>
  </div>
</template>

<script>
  import moment from "moment";

  export default {
    props: {
      message: {
        required: true,
        type: Object
      }
    },
    computed: {
      occurred_at: function () {
        return moment(this.message.occurred_at).format("MMMM D, YYYY") + " at " + moment(this.message.occurred_at).format("h:mm a");
      }
    }
  }
</script>