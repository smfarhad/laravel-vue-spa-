<template>
  <v-container>
    <v-form @submit.prevent="signup">
      <v-text-field type="text" v-model="form.name" label="Name" required></v-text-field>
      <span class="red--text" v-if="errors.name" small>{{errors.name[0]}}</span>
      <v-text-field type="email" v-model="form.email" label="E-mail" required></v-text-field>
      <span class="red--text" v-if="errors.email" small>{{errors.email[0]}}</span>
      <v-text-field type="password" v-model="form.password" label="Password" required></v-text-field>
      <span class="red--text caption" v-if="errors.password">{{errors.password[0]}}</span>
      <v-text-field
        type="password"
        v-model="form.password_confirmation"
        label="Password Confirmation"
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
      },
      errors: {}
    };
  },
  created() {
    if (User.loggedIn()) {
      this.$router.push({ name: "forum" });
    }
  },
  methods: {
    signup() {
      axios
        .post("/api/auth/register", this.form)
        .then(res => {
          User.login(this.form);
          this.$router.push({ name: "forum" });
        })

        .catch(error => (this.errors = error.response.data.errors));
    }
  }
};
</script>
<style>
</style>