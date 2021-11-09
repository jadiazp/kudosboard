<template lang="">
  <section class="section">
    <div class="container">
      <div class="columns is-vcentered is-justify-content-space-between">
        <a @click="returnList">< Return to the kudos list</a>
      </div>
      <div class="columns">
        <div class="column is-8 is-offset-2">
          <h2 class="title has-text-centered">Please, write your comment</h2>

          <form method="post" @submit.prevent="saveKudo">
            <div class="field">
              <div class="control">
                <b-select placeholder="Select a user" expanded @input="selectUser" required>
                  <option
                    v-model="selectedUser"
                    v-for="user in users"
                    :value="user.id"
                    :key="user.id">
                    {{ user.name }}
                  </option>
                </b-select>
              </div>
            </div>

            <div class="field">
              <div class="control">
                <b-field label="Comment">
                  <b-input v-model="comment" required maxlength="200" type="textarea"></b-input>
                </b-field>
              </div>
            </div>

            <div class="control">
              <button type="submit" class="button is-dark is-fullwidth">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <b-loading :is-full-page="isFullPage" v-model="isLoading" :can-cancel="false"></b-loading>
  </section>
</template>
<script>
export default {
  middleware: 'auth',
  data() {
    return {
      comment: '',
      isLoading: false,
      isFullPage: true,
      users: [],
      selectedUser: ''
    };
  },

  props: {
    options: {
      type: Array,
    },
  },

  async created(){
    this.users = this.$store.state.usersList;
  },

  methods:{
    async saveKudo() {
      this.isLoading = true;
      const iduserRegistrant = this.$store.state.user.id;
      const idboard = this.$store.state.selectedBoard;
      const token = `Bearer ${this.$store.state.token}`;
      const data = {
        iduser: iduserRegistrant,
        idboard: idboard,
        description: this.comment,
        iduserto: this.selectedUser
      };
      const response = await this.$axios.post('http://localhost/api/kudos', data, {
        headers:{
          'Authorization': token
        }
      });

      if(response.statusText == "OK"){
        this.$router.push(`/board/${idboard}`);
      }
    },

    async returnList(){
      this.isLoading = true;
      this.$router.back();
    },

    async selectUser(user){
      this.selectedUser = user;
    }
  }
}
</script>
<style lang="">

</style>
