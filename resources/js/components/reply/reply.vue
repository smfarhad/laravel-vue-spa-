<template>
  <div>
    <div v-if="!editing">
      <v-list-item three-line>
        <v-list-item-content>
          <div class="overline mb-4"></div>
          <v-list-item-title>
            {{data.user}} -
            <span class="caption">{{data.created_at}}</span>
          </v-list-item-title>
          <v-divider></v-divider>
          <v-list-item-subtitle v-html="data.reply"></v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>
      <v-card-actions v-if="!own">
        <v-btn text small>
          <v-icon color="orange" @click="edit()">fas fa-edit</v-icon>
        </v-btn>
        <v-btn text small>
          <v-icon color="red" @click="destroy">fas fa-trash</v-icon>
        </v-btn>
      </v-card-actions>
    </div>
    <div v-else>
      <edit-reply :data="data"></edit-reply>
    </div>
  </div>
</template>
<script>
import EditReply from "./editReply";
export default {
  components: { EditReply },
  props: ["data", "index"],
  data() {
    return {
      editing: false,
      beforeEditReplyBody: ""
    };
  },
  created() {
    this.listen();
  },
  computed: {
    own() {
      return User.own(this.data.user_id);
    },
    reply() {}
  },
  methods: {
    edit() {
      this.editing = true;
      this.beforeEditReplyBody = this.data.reply;
    },
    destroy() {
      EventBus.$emit("deleteReply", this.index);
    },
    listen() {
      EventBus.$on("cancelEditing", reply => {
        this.editing = false;
        if (reply !== this.data.reply) {
          this.data.reply = reply;
        }
      });
    }
  }
};
</script>
<style>
</style>