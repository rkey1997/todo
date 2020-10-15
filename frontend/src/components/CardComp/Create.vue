<template>
  <div>
    <v-dialog value="true" width="500" persistent>
      <v-card>
        <v-card-title class="headline grey lighten-2">
          <span> add a list </span>
          <v-spacer></v-spacer>
          <v-btn @click="$emit('close')" text color="primary"> close </v-btn>
        </v-card-title>

        <v-card-text>
          <v-text-field v-model="login" label="login"></v-text-field>
          <v-text-field v-model="email" label="email"></v-text-field>
          <v-text-field v-model="password" label="password"></v-text-field>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" @click="addNewList()">add</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
export default {
  data: () => ({
    // addList: false,
    login: "",
    password: "",
    email: "",
  }),
  methods: {
    // close() {
    //   this.addList = false;
    // },
    addNewList() {
      this.$axios
        .post("/site/create", {
          login: this.login,
          password: this.password,
          email: this.email,
        })
        .then(function (response) {});
      this.$emit("close");
      this.$emit("input");
    },
  },
};
</script>