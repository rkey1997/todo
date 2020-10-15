<template>
  <div class="index">
    <UpdatePopup
      v-if="updateDialog"
      :id="updateDialogId"
      @close="updateDialog = false"
      @input="getObnov()"
    ></UpdatePopup>
    <Create 
    @close="CreateDialog = false"
     v-if="CreateDialog" 
     @input="getObnov()">
      </Create>

    <v-toolbar dark dense color="primary">
      <v-btn @click="CreateDialog = true" text dark>
        <v-icon>mdi-plus-circle</v-icon>
      </v-btn>
      <v-spacer></v-spacer>
      <v-toolbar-title>some list</v-toolbar-title>
      <v-spacer></v-spacer>
      <Found />
    </v-toolbar>

    <v-row class="mx-2">
      <v-col>
        <v-text-field
          class
          name="name"
          v-model="login"
          label="login"
        ></v-text-field>
      </v-col>
      <v-col>
        <v-text-field
          name="name "
          v-model="password"
          label="password"
        ></v-text-field>
      </v-col>
    </v-row>

    <v-simple-table fixed-header>
      <template v-slot:default>
        <thead>
          <tr>
            <th>
              <b>ID</b>
            </th>
            <th>
              <b>LOGIN</b>
            </th>
            <th>
              <b>PASSWORD</b>
            </th>
            <th>
              <b>MAIL</b>
            </th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, i) in Contacts" :key="i">
            <td>{{ item.id_user }}</td>
            <td>{{ item.login }}</td>
            <td>{{ item.password }}</td>
            <td>{{ item.email }}</td>
            <td>
              <span>
                <v-btn @click="del(item.id_user)" text small color="primary">
                  <v-icon>mdi-trash-can-outline</v-icon>
                </v-btn>
              </span>
              <span>
                <v-btn
                  text
                  small
                  color="primary"
                  icon
                  @click="updateDevice(item.id_user)"
                >
                  <v-icon>mdi-pencil</v-icon>
                </v-btn>
              </span>
              <span>
                <v-btn
                  @click="onViewClickHandler(item.id_user)"
                  color="primary"
                  small
                  text
                >
                  <v-icon>mdi-eye-outline</v-icon>
                </v-btn>
              </span>
            </td>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
  </div>
</template>

<script>
import UpdatePopup from "@/components/CardComp/UpdatePopup";
import Create from "@/components/CardComp/Create";
import Found from "@/components/CardComp/Found";
export default {
  components: {
    UpdatePopup,
    Create,
    Found,
  },
  data: () => ({
    Contacts: [],
    login: "",
    password: "",
    timer: null,
    updateDialog: false,
    updateDialogId: 0,
    CreateDialog: false,
  }),
  mounted: function () {
    this.getObnov();
  },
  methods: {
    onViewClickHandler(id) {
      this.$router.push({ path: "/view", query: { id: id } });
    },
    getObnov() {
      this.$axios
        .get("/site/index", {
          params: {
            login: this.login,
            password: this.password,
          },
        })
        .then((response) => {
          console.log(response.data);
          this.Contacts = response.data.item.slice();
        });
    },
    del(id) {
      this.$axios.post("site/delete", { id: id }).then((r) => {
        this.getObnov();
      });
    },

    close() {
      this.foundList = false;
    },
    updateDevice(id) {
      this.updateDialogId = id;
      this.updateDialog = true;
    },
  },
  watch: {
    login(newVal, oldVal) {
      clearTimeout(this.timer);
      var self = this;
      this.timer = setTimeout(function () {
        self.getObnov();
      }, 2000);
    },
    password(newVal, oldVal) {
      clearTimeout(this.timer);
      var self = this;
      this.timer = setTimeout(function () {
        self.getObnov();
      }, 500);
    },
  },
};
</script>



