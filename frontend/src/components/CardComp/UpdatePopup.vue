<template>
  <v-dialog value="true" width="500" persistent>
    <v-card>
      <v-card-title class="headline grey lighten-2">
        <span> Chenge this list </span>
        <v-spacer></v-spacer>
        <v-btn text color="primary" @click="$emit('close')"> close </v-btn>
      </v-card-title>

      <v-card-text>
        <v-text-field v-model="Contact.login" label="login"></v-text-field>
        <v-text-field v-model="Contact.email" label="email"></v-text-field>
        <v-text-field
          v-model="Contact.password"
          label="password"
        ></v-text-field>
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn @click="ChangeList" color="primary">change</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: ["id"],
  data: function () {
    return {
      Contact: {},
    };
  },
  mounted() {
    this.$axios.get("site/view", { params: { id: this.id } }).then((r) => {
      this.Contact = r.data;
    });
  },
  methods: {
    ChangeList() {
      this.$axios.post("site/update", {
        id: this.id,
        password: this.Contact.password,
        login: this.Contact.login,
        email: this.Contact.email,
      });
      this.$emit("input");
      this.$emit("close");
    },
  },
};
</script>