<template>
  <div>
    <edit-question v-if="editing" :data="question"></edit-question>
    <div v-else>
      <show-question v-if="question" :data="question"></show-question>
      <replies :question="question"></replies>
      <new-reply :questionSlug="question.slung"></new-reply>
    </div>
  </div>
</template>
<script>
import ShowQuestion from "./ShowQuestion";
import EditQuestion from "./EditQuestion";
import Replies from "../reply/Replies";
import NewReply from "../reply/newReply";

export default {
  components: { ShowQuestion, EditQuestion, Replies, NewReply },
  data() {
    return {
      question: null,
      editing: false
    };
  },
  created() {
    this.listen();
    this.getQuestion();
  },
  computed: {},
  methods: {
    listen() {
      EventBus.$on("startEditing", () => {
        this.editing = true;
      });
      EventBus.$on("cancelEditing", () => {
        this.editing = false;
        window.scrollTo(0, 0);
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