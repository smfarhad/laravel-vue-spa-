<template>
  <div>
    <edit-question v-if="editing" :data="question"></edit-question>
    <div v-else>
      <show-question v-if="question" :data="question"></show-question>
    </div>
  </div>
</template>
<script>
import ShowQuestion from "./ShowQuestion";
import EditQuestion from "./EditQuestion";
export default {
  data() {
    return {
      question: null,
      editing: false
    };
  },
  components: { ShowQuestion, EditQuestion },
  created() {
    this.listen();
    this.getQuestion();
  },
  methods: {
    listen() {
      EventBus.$on("startEditing", () => {
        this.editing = true;
      });
      EventBus.$on("cancelEditing", () => {
        this.editing = false;
      });
    },
    getQuestion() {
      axios
        .get(`/api/question/${this.$route.params.slung}`)
        .then(res => (this.question = res.data.data));
    }
  }
};
</script>
<style></style>