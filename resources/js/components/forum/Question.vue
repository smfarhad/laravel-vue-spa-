<template>
  <div>
    <v-card-title>
      <router-link :to="data.path">{{data.title}}</router-link>
    </v-card-title>
    <v-card-subtitle class="pb-0">{{data.user }} | {{data.created_at}}</v-card-subtitle>

    <v-card-text class="text--primary">
      <div v-html="body"></div>
    </v-card-text>

    <v-card-actions></v-card-actions>
  </div>
</template>
<script>
export default {
  props: ["data"],
  computed: {
    body() {
      return md.parse(this.data.body);
    }
  }
};
</script>
<style></style>