<template>
  <v-card mt-2>
    <v-card-title>Side Bar</v-card-title>
    <v-card-text class="text--primary">
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title v-for="category in categories" :key="category.id">{{category.name}}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-card-text>
  </v-card>
</template>
<script>
export default {
  data() {
    return {
      categories: {}
    };
  },
  created() {
    axios.get("/api/category").then(res => (this.categories = res.data.data));
  },
  computed: {},
  methods: {}
};
</script>
<style></style>