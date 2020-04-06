<template>
  <v-container>
    <v-form @submit.prevent>
      <v-card>
        <v-toolbar flat>
          <v-icon>fas fa-question &nbsp;</v-icon>
          <v-toolbar-title class="font-weight-light">&nbsp; Edit Reply</v-toolbar-title>
          <v-spacer></v-spacer>
        </v-toolbar>
        <v-card-text>
          <!-- use v-model control value -->
          <vue-simplemde v-model="form.body" value="100" ref="markdownEditor" />
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn type="submit" color="success" @click="update()">Save</v-btn>
          <v-btn type="submit" color="default" @click="cancel()">Cancel</v-btn>
        </v-card-actions>
      </v-card>
    </v-form>
  </v-container>
</template>
<script>
import VueSimplemde from "vue-simplemde/src/index.vue";
export default {
  props: ["questionSlug", "data", "editing"],
  data() {
    return {
      form: {
        body: this.data.reply
      },
      categories: [],
      errors: {}
    };
  },
  components: {
    VueSimplemde
  },
  computed: {},
  methods: {
    cancel(reply) {
      EventBus.$emit("cancelEditing", reply);
    },
    update() {
      axios
        .patch(
          `/api/question/${this.data.question_slung}/reply/${this.data.id}`,
          { body: this.form.body }
        )
        .then(res => this.cancel(this.form.body));
    }
  }
};
</script>
<style>
@import "~simplemde/dist/simplemde.min.css";
</style>