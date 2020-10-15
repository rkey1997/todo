<template>
  <div>
    <v-dialog v-model="foundList" width="400">
      <template v-slot:activator="{ on, attr }">
        <v-btn text dark v-bind="{attr}" v-on="on">
          <v-icon>mdi-magnify</v-icon>
        </v-btn>
      </template>

      <v-card>
        <v-card-title class="headline grey lighten-2">found for id</v-card-title>

        <v-card-text>
          <v-row class="justify-space-between">
            <v-col sm="8">
              <v-text-field placeholder="ID" @keyup.enter="found" v-model="param"></v-text-field>
            </v-col>
            <v-col sm="3">
              <v-btn @click="found" text class="mb-3" color="primary">found</v-btn>
            </v-col>
          </v-row>
          <div class="found_info mb-4">
            <div>
              <span class="mr-3 text">login:</span>
              {{Contact.login}}
            </div>
            <div>
              <span class="mr-3">password:</span>
              {{Contact.password}}
            </div>
            <div>
              <span class="mr-3 text">email:</span>
              {{Contact.email}}
            </div>
          </div>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text @click="close" color="primary">close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
export default {
       data: () => ({
    Contact: {},
    foundList: false,
    login: "",
    password: "",
    email: "",
    param: "",
  }),
   methods: {
    found() {
      this.$axios
        .get("site/stroki", { params: { myValue: this.param }  })
        .then((r) => {
          this.Contact = r.data;
        });
    },
    close() {
      this.foundList = false;
    },
   }
}
</script>