<template>
  <v-container>
    <v-form @submit.prevent="createCategory">
      <v-card>
        <v-toolbar flat>
          <v-icon>fas fa-category &nbsp;</v-icon>
          <v-toolbar-title class="font-weight-light">&nbsp; Create Category</v-toolbar-title>
          <v-spacer></v-spacer>
        </v-toolbar>
        <v-card-text>
          <v-text-field type="text" v-model="form.name" label="Name" required></v-text-field>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn type="submit" color="success" v-if="!editSlung">Create</v-btn>
          <v-btn type="submit" color="warning" v-else>Update</v-btn>
        </v-card-actions>
      </v-card>
    </v-form>

    <v-card class="mx-auto">
      <v-toolbar color="primary darken-4" dark>
        <v-app-bar-nav-icon></v-app-bar-nav-icon>
        <v-toolbar-title>Category</v-toolbar-title>
        <v-spacer></v-spacer>
      </v-toolbar>
      <v-card-text>
        <v-simple-table>
          <template v-slot:default>
            <thead>
              <tr>
                <th class="text-left">Name</th>
                <th class="text-left">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(category,index) in categories" :key="category.id">
                <td>{{category.name}}</td>
                <td>
                  <v-btn icon @click="destroy(category.slung, index)" class="float-right" small>
                    <v-icon color="red" small>fas fa-trash-alt</v-icon>
                  </v-btn>
                  <v-btn icon right @click="edit(category.slung, index)" class="float-right" small>
                    <v-icon color="orange" small>fas fa-edit</v-icon>
                  </v-btn>
                </td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </v-card-text>
    </v-card>
  </v-container>
</template>
    </v-simple-table>
  </v-container>
</template>


  </v-container>
</template>
<script>
export default {
  data() {
    return {
      form: {
        name: null,
        slung: null
      },
      response: null,
      categories: {},
      errors: {},
      editSlung: false
    };
  },
  components: {},
  created() {
    if (!User.admin()) {
      this.$router.push("/forum");
    } else {
      this.loadData();
    }
  },
  methods: {
    createCategory() {
      if (!User.admin()) {
        this.$router.push("/forum");
      } else {
        if (!this.editSlung) {
          this.create();
        } else {
          this.update();
        }
      }
    },
    create() {
      axios
        .post("/api/category", this.form)
        .then(res => {
          this.loadData();
          this.form.name = null;
        })
        .catch(error => (this.errors = error.response.data.errors));
    },
    update() {
      axios
        .patch(`/api/category/${this.form.slung}`, this.form)
        .then(res => {
          this.loadData();
          this.form.name = null;
        })
        .catch(error => (this.errors = error.response.data.errors));
    },
    edit(slung, index) {
      this.form.name = this.categories[index].name;
      this.editSlung = true;
      this.form.slung = slung;
    },
    destroy(slug, index) {
      axios
        .delete(`/api/category/${slug}`)
        .then(res => {
          this.categories.splice(index, 1);
        })
        .then(this.loadData())
        .catch(error => (this.errors = error.response.data.errors));
    },
    loadData() {
      axios.get("/api/category").then(res => (this.categories = res.data.data));
    }
  }
};
</script>
<style>
@import "~simplemde/dist/simplemde.min.css";
</style>


