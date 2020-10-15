<template>
  <div class="view" >
    <v-main>
      <v-container>
        <div class="my-5">
          <v-btn to="/" large text color="primary">
            <v-icon large>mdi-arrow-left-circle-outline</v-icon>
          </v-btn>
        </div>
        <v-card width="400" class="mx-auto">
          <v-card-title class="headline primary white--text">
            This list
          </v-card-title>
          <v-card-text class="black--text">
            <div class="my-3">
              <span class="mr-3">ID:</span><span>{{ Contact.id_user }}</span>
            </div>
            <div class="my-3">
              <span class="mr-3">Login:</span><span>{{ Contact.login }}</span>
            </div>
            <div class="my-3">
              <span class="mr-3">Password:</span
              ><span>{{ Contact.password }}</span>
            </div>
            <div class="my-3">
              <span class="mr-3">Email:</span><span>{{ Contact.email }}</span>
            </div>
          </v-card-text>
        </v-card>
      </v-container>
    </v-main>
  </div>
</template>

<script>
export default {
  data: () => ({
    Contact: {},
  }),


  mounted: function () {
    this.$axios
      .get("/site/view", { params: { id: this.$route.query.id } })
      .then((response) => {
        this.Contact = response.data;
      });
  },
};
</script>

