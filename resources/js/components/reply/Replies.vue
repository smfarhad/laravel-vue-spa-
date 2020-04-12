<template>
  <v-container>
    <div>
      <v-card class="mx-auto" outlined>
        <reply v-for="(reply, index) in content" :key="index" :index="index" :data="reply"></reply>
      </v-card>
    </div>
  </v-container>
</template>
<script>
import Reply from "./reply";
export default {
  props: ["question"],
  data() {
    return {
      content: this.question.replies
    };
  },
  components: { Reply },
  created() {
    this.listen();
  },
  methods: {
    listen() {
      EventBus.$on("newReply", reply => {
        this.content.unshift(reply);
      });
      EventBus.$on("deleteReply", index => {
        axios
          .delete(
            `/api/question/${this.question.slung}/reply/${this.content[index].id}`
          )
          .then(this.content.splice(index, 1));
      });
      Echo.private("App.User." + User.id()).notification(notification => {
        this.content.unshift(notification.reply);
      });
      Echo.channel("deleteReplyChannel").listen("DeleteReplyEvent", e => {
        for (let index = 0; index < this.content.length; index++) {
          if (this.content[index].id == e.id) {
            this.content.splice(index, 1);
          }
        }
      });
    }
  }
};
</script>
<style>
</style>