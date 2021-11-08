<template>
  <div>
    <nav class="navbar is-dark">
      <div class="container">
        <div class="navbar-brand">
          <nuxt-link class="navbar-item" to="/">KudosBoard</nuxt-link>
          <button class="button navbar-burger">
            <span></span>
            <span></span>
            <span></span>
          </button>
        </div>
        <div class="navbar-menu">
          <div class="navbar-end">
            <div class="navbar-item has-dropdown is-hoverable">
              <a class="navbar-link" v-if="this.$store.state.token">
                {{ this.$store.state.user.firstname }} {{ this.$store.state.user.lastname }}
              </a>
              <div class="navbar-dropdown">
                <a class="navbar-item" @click="logout">Logout</a>
              </div>
            </div>
            <template v-if="!this.$store.state.token || this.$store.state.token == ''">
              <nuxt-link class="navbar-item" to="/login">Log In</nuxt-link>
            </template>
          </div>
        </div>
      </div>
    </nav>
    <b-loading :is-full-page="isFullPage" v-model="isLoading" :can-cancel="false"></b-loading>
  </div>
</template>
<script>
export default {
  data() {
    return {
      isLoading: false,
      isFullPage: true
    };
  },

  methods: {
    async logout(){
      try {
        this.isLoading = true;
        const token = 'Bearer ' + this.$store.state.token;
        const response = await this.$axios.post('http://localhost/api/auth/logout', {}, {
          headers:{
            'Authorization': token
          }
        });

        const status = response.statusText;
        if(status == 'OK'){
          this.isLoading = false;
          this.$store.commit('setUser', '');
          this.$store.commit('setToken', '');
          this.$router.push('/login');
        }
      } catch (e) {
        //this.error = e.response.data.message;
        console.log(e);
        this.isLoading = false;
        this.$router.push('/login');
      }
    }
  }
}
</script>
