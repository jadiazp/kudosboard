<template>
  <div class="hero-body">
    <div class="container">
      <div class="columns is-centered">
        <div class="column is-5-tablet is-6-desktop is-4-widescreen">
          <form action="" class="box">
            <div class="field">
              <label for="" class="label">Email</label>
              <div class="control">
                <input v-model="email" type="email" placeholder="e.g. bobsmith@gmail.com" class="input" required>
              </div>
            </div>
            <div class="field">
              <label for="" class="label">Password</label>
              <div class="control">
                <input v-model="password" type="password" placeholder="*******" class="input" required>
              </div>
            </div>
            <div class="field">
              <label for="" class="checkbox">
                <input type="checkbox">
               Remember me
              </label>
            </div>
            <div class="field">
              <b-button
                type="is-primary"
                @click="saveAssignment"
                :loading="savingAssignment"
              >Login</b-button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</template>
<script>
import axios, * as others from 'axios';

export default {
  name:"Login",
  layout:"auth",

  data(){
    return {
      savingAssignment: null,
      email: null,
      password: null
    }
  },

  methods:{
    async saveAssignment(){
      /*const response = await this.$axios({
        method: 'post',
        url: 'http://localhost/api/auth/login',
        data: {
          email: this.email,
          password: this.password
        }
      });*/

      window.open('/opportunities', '_self');

      //console.log(response.data);
    }
  }
}
</script>
