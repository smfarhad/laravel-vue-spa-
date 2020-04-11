<template>
  <v-btn icon :color="likeColor" @click="likeIt()">
    <v-icon>mdi-heart</v-icon>
    {{count}}
  </v-btn>
</template>
<script>
export default {
  props: ["content"],
  data() {
    return {
      liked: this.content.liked,
      count: this.content.like_count
    };
  },
  created() {
    Echo.channel("likeChannel").listen("LikeEvent", e => {
      if (this.content.id == e.id) {
        e.type == 1 ? this.count++ : this.count--;
      }
    });
  },
  computed: {
    likeColor() {
      return this.liked ? "red" : "red lighten-4 ";
    }
  },
  methods: {
    likeIt() {
      if (User.loggedIn()) {
        if (this.liked) {
          this.decr();
        } else {
          this.incr();
        }
        this.liked = !this.liked;
      }
    },
    incr() {
      axios.post(`/api/like/${this.content.id}`).then(res => this.count++);
    },
    decr() {
      if (this.count > 0) {
        axios.delete(`/api/like/${this.content.id}`).then(res => this.count--);
      } else {
        this.count = 0;
      }
    }
  }
};
</script>
<style scoped>
</style>