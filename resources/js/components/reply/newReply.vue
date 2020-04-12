<template>
  <v-container>
    <v-form v-if="loggedIn" @submit.prevent="createReply">
      <v-card>
        <v-toolbar flat>
          <v-icon>fas fa-question &nbsp;</v-icon>
          <v-toolbar-title class="font-weight-light">&nbsp; Create New Reply</v-toolbar-title>
          <v-spacer></v-spacer>
        </v-toolbar>
        <v-card-text>
          <!-- use v-model control value -->
          <vue-simplemde v-model="form.body" ref="markdownEditor" />
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn type="submit" color="success">Reply</v-btn>
        </v-card-actions>
      </v-card>
    </v-form>
    <div v-else>
      <router-link to="/login">Login in to Reply</router-link>
    </div>
  </v-container>
</template>
<script>
import VueSimplemde from "vue-simplemde/src/index.vue";
export default {
  props: ["questionSlug"],
  data() {
    return {
      form: {
        body: null
      },
      categories: [],
      errors: {}
    };
  },
  components: {
    VueSimplemde
  },
  computed: {
    loggedIn() {
      return User.loggedIn();
    }
  },
  methods: {
    createReply() {
      axios
        .post(`/api/question/${this.questionSlug}/reply`, this.form)
        .then(res => {
          this.form.body = "";
          EventBus.$emit("newReply", res.data.reply);
          window.scrollTo(0, 0);
        });
    }
  }
};
</script>
<style>
@import "~simplemde/dist/simplemde.min.css";
</style>