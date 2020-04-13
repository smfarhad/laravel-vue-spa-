<template>
  <v-container>
    <v-form @submit.prevent="createQuestion">
      <v-card>
        <v-toolbar flat>
          <v-icon>fas fa-question &nbsp;</v-icon>
          <v-toolbar-title class="font-weight-light">&nbsp; Ask Question</v-toolbar-title>
          <v-spacer></v-spacer>
        </v-toolbar>
        <v-card-text>
          <span class="red--text" v-if="errors.title">{{ errors.title[0] }}</span>
          <v-text-field type="text" v-model="form.title" label="Title" required></v-text-field>
          <span class="red--text" v-if="errors.category_id">{{ errors.category_id[0] }}</span>
          <v-autocomplete
            v-model="form.category_id"
            :items="categories"
            item-text="name"
            item-value="id"
            label="Category"
          ></v-autocomplete>
          <!-- use v-model control value -->
          <span class="red--text" v-if="errors.body">{{ errors.body[0] }}</span>
          <vue-simplemde v-model="form.body" ref="markdownEditor" />
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn type="submit" color="success" :disabled="createDisable">Create</v-btn>
        </v-card-actions>
      </v-card>
    </v-form>
  </v-container>
</template>
<script>
import VueSimplemde from "vue-simplemde/src/index.vue";
export default {
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
  created() {
    axios.get("/api/category").then(res => (this.categories = res.data.data));
  },
  computed: {
    createDisable() {
      return !(this.form.title && this.form.category_id && this.form.body);
    }
  },
  methods: {
    createQuestion() {
      axios
        .post("/api/question", this.form)
        .then(res => this.$router.push(res.data.path))
        .catch(error => (this.errors = error.response.data.errors));
    }
  }
};
</script>
<style>
@import "~simplemde/dist/simplemde.min.css";
</style>


