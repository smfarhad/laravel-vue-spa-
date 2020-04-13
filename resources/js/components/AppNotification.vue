<template>
  <div class="text-center">
    <div></div>

    <v-menu offset-y>
      <template v-slot:activator="{ on }">
        <v-btn small icon v-on="on">
          <v-icon small :color="color">fas fa-bell</v-icon>
          <sup :color="color">{{unReadCount}}</sup>
        </v-btn>
      </template>
      <v-list>
        <v-list-item v-for="item in unRead" :key="item.id">
          <router-link :to="item.path">
            <v-list-item-title @click="readIt(item.id)">{{item.question}}</v-list-item-title>
          </router-link>
        </v-list-item>
        <v-list-item v-for="item in Read" :key="item.id">
          <v-list-item-title v-if="item.read_at">{{item.question}}</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
  </div>
</template>
<script>
export default {
  data() {
    return {
      Read: {},
      unRead: {},
      unReadCount: 0,
      sound: "http://soundbible.com/mp3/glass_ping-Go445-1207030150.mp3"
    };
  },
  created() {
    if (User.loggedIn()) {
      this.getNotificitions();
    }
    Echo.private("App.User." + User.id()).notification(notification => {
      this.playSound();
      this.unRead.unshift(notification);
      this.unReadCount++;
    });
  },
  computed: {
    color() {
      return this.unReadCount > 0 ? "red" : "red lighten-4";
    }
  },
  methods: {
    playSound() {
      let alert = new Audio(this.sound);
      alert.play();
    },
    getNotificitions() {
      axios
        .post("/api/notifications")
        .then(res => {
          this.Read = res.data.read;
          this.unRead = res.data.unRead;
          this.unReadCount = res.data.count;
        })
        .catch(error => Exception.handle(error));
    },
    readIt(notification) {
      axios.post("/api/markAsRead", { id: notification }).then(res => {
        this.unRead.splice(notification, 1);
        this.Read.push(notification);
        this.unReadCount--;
      });
    }
  }
};
</script>
<style scoped>
</style>