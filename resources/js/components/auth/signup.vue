<template>
  <v-container>
    <v-form @submit.prevent="signup">
      <v-text-field type="text" v-model="form.name" label="Name" required></v-text-field>
      <v-text-field type="email" v-model="form.email" label="E-mail" required></v-text-field>
      <v-text-field type="password" v-model="form.password" label="Password" required></v-text-field>
      <v-text-field
        type="password"
        v-model="form.password_confirmation"
        label="Confirm Password"
        required
      ></v-text-field>
      <v-btn type="submit" color="primary">Sign Up</v-btn>
      <router-link to="/login">
        <v-btn text small color="green">Login</v-btn>
      </router-link>
    </v-form>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: null,
        email: null,
        password: null,
        password_confirmation: null
      }
    };
  },
  methods: {
    signup() {
      // User.login(this.form);
      axios
        .post("/api/auth/register", this.form)
        .then(res => User.responseAfterLogin(res))
        .catch(error => console.log(error.response.data));
    }
  }
};
</script>
<style>
</style>