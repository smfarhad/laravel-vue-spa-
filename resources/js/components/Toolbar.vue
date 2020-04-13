<template>
  <v-card color="indigo lighten-4" flat height tile>
    <v-toolbar color="indigo" dense dark>
      <!-- <v-app-bar-nav-icon></v-app-bar-nav-icon> -->

      <v-toolbar-title>
        <router-link class="white--text" to="/">SPA</router-link>
      </v-toolbar-title>

      <v-spacer></v-spacer>
      <app-notification v-if="loggedIn"></app-notification>

      <router-link v-for="item in items" :key="item.title" :to="item.to" v-if="item.show">
        <v-btn text small>{{item.title}}</v-btn>
      </router-link>
    </v-toolbar>
  </v-card>
</template>
<script>
import AppNotification from "./AppNotification";
export default {
  components: { AppNotification },
  data() {
    return {
      loggedIn: User.loggedIn(),
      items: [
        { title: "Forum", to: "/forum", show: true },
        { title: "Ask Question", to: "/ask", show: User.loggedIn() },
        { title: "Category", to: "/category", show: User.admin() },
        { title: "Login", to: "/login", show: !User.loggedIn() },
        { title: "Logout", to: "/logout", show: User.loggedIn() }
      ]
    };
  },
  created() {
    EventBus.$on("logout", () => {
      User.logOut();
    });
  }
};
</script>
<style></style>