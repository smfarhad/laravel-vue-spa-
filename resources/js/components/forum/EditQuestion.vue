<template>
  <v-container>
    <v-form @submit.prevent="updateQuestion">
      <v-card>
        <v-toolbar flat>
          <v-icon>fas fa-question &nbsp;</v-icon>
          <v-toolbar-title class="font-weight-light">&nbsp; Ask Question</v-toolbar-title>
          <v-spacer></v-spacer>
        </v-toolbar>
        <v-card-text>
          <v-text-field type="text" v-model="form.title" label="Title" required></v-text-field>
          <v-autocomplete
            v-model="form.category_id"
            :items="categories"
            item-text="name"
            item-value="id"
            label="Category"
          ></v-autocomplete>
          <!-- use v-model control value -->
          <vue-simplemde v-model="form.body" ref="markdownEditor" />
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn type="submit" color="success">Save</v-btn>
          <v-btn type="button" color="default" @click="cancel">Cancel</v-btn>
        </v-card-actions>
      </v-card>
    </v-form>
  </v-container>
</template>
<script>
import VueSimplemde from "vue-simplemde/src/index.vue";
export default {
  props: ["data"],
  data() {
    return {
      form: {
        title: null,
        category_id: null,
        body: null
      },
      categories: [],
      errors: {}
    };
  },
  components: {
    VueSimplemde
  },
  mounted() {
    axios.get("/api/category").then(res => (this.categories = res.data.data));
  },

  methods: {
    updateQuestion() {
      axios
        .patch(`/api/question/${this.form.slung}`, this.form)
        .then(res => this.cancel());
    },
    cancel() {
      EventBus.$emit("cancelEditing");
    }
  },
  created() {
    this.form = this.data;
  }
};
</script>
<style>
@import "~simplemde/dist/simplemde.min.css";
</style>


