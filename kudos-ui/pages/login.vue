<template>
  <section class="section">
    <div class="container">
      <div class="columns">
        <div class="column is-4 is-offset-4">
          <h2 class="title has-text-centered">Welcome!</h2>

          <Notification :message="error" v-if="error"/>

          <form method="post" @submit.prevent="login">

            <div class="field">
              <label class="label">Email</label>

              <div class="control">
                <input
                  type="email"
                  class="input"
                  required="required"
                  name="email"
                  v-model="email"
                >
              </div>
            </div>

            <div class="field">
              <label class="label">Password</label>

              <div class="control">
                <input
                  type="password"
                  class="input"
                  required="required"
                  name="password"
                  v-model="password"
                >
              </div>
            </div>

            <div class="control">
              <button type="submit" class="button is-dark is-fullwidth">Log In</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <b-loading :is-full-page="isFullPage" v-model="isLoading" :can-cancel="false"></b-loading>
  </section>
</template>

<script>
import Pusher from 'pusher-js';
import Notification from '~/components/Notification';
export default {
  components: {
    Notification,
  },
  data() {
    return {
      email: '',
      password: '',
      error: null,
      userObject: null,
      token: null,
      isLoading: false,
      isFullPage: true,
    };
  },

  mounted(){

  },

  methods: {
    async login() {
      this.isLoading = true;
      try {
        const response = await this.$axios.post('http://localhost/api/auth/login', {
          email: this.email,
          password: this.password,
        });
        const status = response.data.status;

        if(status == 'error'){
          this.error = response.data.message;
        }else{
          this.userObject = response.data.user;
          this.token = response.data.access_token;

          this.$store.commit('setUser', this.userObject);
          this.$store.commit('setToken', this.token);

          //Get list of users
          const response_users = await this.$axios.get('http://localhost/api/users', {
            headers:{
              'Authorization': `Bearer ${this.token}`
            }
          });
          this.$store.commit('setUsersList', response_users.data);
          this.isLoading = false;
          this.$router.push('/');

        }
      } catch (e) {
        console.log(e);
      }
    },

    openLoading() {
      this.isLoading = true;
    },

  },
};
</script>
