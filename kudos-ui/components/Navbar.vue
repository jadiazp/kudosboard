<template>
 <nav class="navbar is-dark" role="navigation" aria-label="main navigation">
    <div class="container">
      <div class="navbar-brand">
        <nuxt-link class="navbar-item" to="/">KudosBoard</nuxt-link>
        <a role="button" @click="setActiveNav" :class="this.burgerClass" aria-label="menu" aria-expanded="false" data-target="mainNavBar">
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
        </a>
      </div>
      <div :class="this.navBarMenu" id="mainNavBar">
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
    <b-loading :is-full-page="isFullPage" v-model="isLoading" :can-cancel="false"></b-loading>
  </nav>
</template>

<script>
export default {
  data() {
    return {
      isLoading: false,
      isFullPage: true,
      firstName: '',
      lasttName: '',
      isActive: false,
      burgerClass: 'navbar-burger',
      navBarMenu: 'navbar-menu'
    };
  },

  mounted(){
    this.firstName = this.$store.state.user.firstname
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
    },

    async setActiveNav(){
      if(this.isActive == false){
        this.isActive = true;
        this.burgerClass ='navbar-burger is-active'
        this.navBarMenu = 'navbar-menu is-active'
      }else{
        this.isActive = false;
        this.burgerClass ='navbar-burger'
        this.navBarMenu = 'navbar-menu'
      }

      console.log(this.isActive);
    }
  }
}
</script>
