<template>
  <v-container>
    <v-row no-gutters>
      <v-col cols="12" sm="6" md="8">
        <v-card class tile>
          <question v-for="(question, i) in questions" :key="i" :data="question"></question>
        </v-card>
      </v-col>
      <v-col cols="6" md="4">
        <app-sidebar></app-sidebar>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
import question from "./question";
import AppSidebar from "./AppSidebar";
export default {
  data() {
    return {
      questions: {}
    };
  },
  components: {
    question,
    AppSidebar
  },
  created() {
    axios
      .get("/api/question")
      .then(res => (this.questions = res.data.data))
      .catch(error => console.log(error.data.data));
  }
};
</script>
<style></style>