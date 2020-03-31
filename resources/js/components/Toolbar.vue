<template>
  <v-card color="grey lighten-4" flat height tile>
    <v-toolbar dense>
      <!-- <v-app-bar-nav-icon></v-app-bar-nav-icon> -->

      <v-toolbar-title>Title</v-toolbar-title>

      <v-spacer></v-spacer>
      <router-link to="/forum">
        <v-btn text small>Forum</v-btn>
      </router-link>

      <v-btn text small>Ask Question</v-btn>
      <v-btn text small>Catrgory</v-btn>

      <router-link to="/login">
        <v-btn text small>Login</v-btn>
      </router-link>
    </v-toolbar>
  </v-card>
</template>
<script>
export default {};
</script>
<style></style>