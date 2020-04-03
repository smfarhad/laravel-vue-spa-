<template>
  <v-container>
    <v-row no-gutters>
      <v-col md="6" offset-md="3">
        <v-card class="pa-2" outlined tile>
          <v-toolbar-title class="font-weight-light">
            <v-icon>fas fa-user &nbsp;</v-icon>&nbsp; User Login
          </v-toolbar-title>
          <v-form @submit.prevent="login">
            <v-text-field type="email" v-model="form.email" label="E-mail" required></v-text-field>
            <v-text-field type="password" v-model="form.password" label="Password" required></v-text-field>
            <v-btn type="submit" color="primary">Login</v-btn>
            <router-link to="/signup">
              <v-btn text small color="green">Sign Up</v-btn>
            </router-link>
          </v-form>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      form: {
        email: null,
        password: null
      }
    };
  },
  created() {
    if (User.loggedIn()) {
      this.$router.push({ name: "forum" });
    }
  },
  methods: {
    login() {
      User.login(this.form);
    }
  }
};
</script>
<style>
</style>