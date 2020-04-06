<template>
  <v-container>
    <v-card mt-2>
      <v-card-title>
        <div class="headline">{{data.title}}</div>
        <v-spacer></v-spacer>
        <v-btn color="red" dark>{{data.num_of_reply}} Replies</v-btn>
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
      own: User.own(this.data.user_id)
    };
  },
  computed: {
    body() {
      return md.parse(this.data.body);
    }
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