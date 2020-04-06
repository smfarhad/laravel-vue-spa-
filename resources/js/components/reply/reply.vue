<template>
  <div>
    <div v-if="!editing">
      <v-list-item three-line>
        <v-list-item-content>
          <div class="overline mb-4"></div>
          <v-list-item-title>
            {{data.user}} -
            <span class="caption">{{data.created_at}}</span>
            <like class="float-right" :content="data"></like>
          </v-list-item-title>
          <v-spacer></v-spacer>

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
import Like from "../likes/like";
export default {
  components: { EditReply, Like },
  props: ["data", "index"],
  data() {
    return {
      editing: false,
      beforeEditReplyBody: ""
    };
  },
  created() {
    //console.log(this.data.like_count);
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
        if (this.data.reply == this.beforeEditReplyBody) {
          this.data.reply = reply;
        }
        window.scrollTo(0, 0);
      });
    }
  }
};
</script>
<style>
</style>