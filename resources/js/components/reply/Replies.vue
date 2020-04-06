<template>
  <v-container>
    <div>
      <v-card class="mx-auto" outlined>
        <reply v-for="(reply, index) in content" :key="reply.id" :index="index" :data="reply"></reply>
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
    }
  }
};
</script>
<style>
</style>