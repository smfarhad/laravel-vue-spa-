<template>
  <v-container>
    <v-card mt-2>
      <v-card-title>
        <div class="headline">{{data.title}}</div>
        <v-spacer></v-spacer>
        <v-btn color="red" dark>{{replyCount}} Replies</v-btn>
      </v-card-title>
      <v-card-subtitle>{{data.user }} | {{data.created_at}}</v-card-subtitle>
      <v-card-text class="text--primary">
        <div v-html="body"></div>
      </v-card-text>
      <v-card-actions v-if="own">
        <v-btn icon>
          <v-icon color="orange" @click="edit">fas fa-edit</v-icon>
        </v-btn>
        <v-btn icon @click="destroy">
          <v-icon color="red">fas fa-trash-alt</v-icon>
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-container>
</template>
<script>
export default {
  props: ["data"],
  data() {
    response: null;
    return {
      own: User.own(this.data.user_id),
      replyCount: this.data.num_of_reply
    };
  },
  computed: {
    body() {
      return md.parse(this.data.body);
    }
  },
  created() {
    EventBus.$on("newReply", () => {
      this.replyCount++;
    });
    EventBus.$on("deleteReply", () => {
      this.replyCount--;
    });
    Echo.private("App.User." + User.id()).notification(notification => {
      this.replyCount++;
    });
    Echo.channel("deleteReplyChannel").listen("DeleteReplyEvent", e => {
      this.replyCount--;
    });
  },
  methods: {
    destroy() {
      axios
        .delete(`/api/question/${this.data.slung}`)
        .then(this.$router.push("/forum"))
        .catch(error => console.log(error.response.data));
    },
    edit() {
      EventBus.$emit("startEditing");
    }
  }
};
</script>
<style></style>