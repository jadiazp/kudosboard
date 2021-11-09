<template lang="">
  <section class="section">
    <div class="container">
      <div class="columns is-vcentered is-justify-content-space-between">
        <nuxt-link to="/">< Return to the boards list</nuxt-link>
        <b-button @click="newKudo" type="is-dark">New Kudo</b-button>
      </div>
      <div class="columns is-desktop is-multiline mt-2">
        <div class="column">
          <div class="board-info">
            <p><h2 class="title is-4 is-white">{{ this.$store.state.boardInfo.board_title }}</h2></p>
            <p class="subtitle is-5 is-grey">{{ this.$store.state.boardInfo.board_description }}</p>
          </div>
        </div>
        <div class="column">
          <div class="board-kudos" v-for="kudo in this.kudosInfo">
            <h5 class="title is-5 is-dark mb-0">{{ kudo.description }}</h5>
            <p>
              Assigned user: {{ kudo.assigned ? kudo.assigned : '-' }}
            </p>
            <p>
              Registrant user: {{ kudo.firstname }} {{ kudo.lastname }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import Pusher from 'pusher-js';
export default {
  middleware: 'auth',
  data() {
    return {
      board: [],
      kudos: [],
      kudosInfo: []
    }
  },

  async mounted(){
    const token = 'Bearer ' + this.$store.state.token;
    const selectedBoard = this.$store.state.selectedBoard;
    const response = await this.$axios.get(`http://localhost/api/boards/${selectedBoard}`, {
      headers:{
        'Authorization': token
      }
    });
    if(response.data.status == "Token is Expired"){
      this.$store.commit('setUser', "");
      this.$store.commit('setToken', "");
      this.$router.push('/');
    }else{
      const board = response.data[0].board;
      const kudos = response.data[0].kudos;
      this.$store.commit('setBoardInfo', board);
      this.$store.commit('setKudosInfo', kudos);
    }

    this.kudosInfo = this.$store.state.kudosInfo;

    var pusher = new Pusher('07289873f974d66ebce6', {
      cluster: 'us2'
    });

    var channel = pusher.subscribe('kudosapp');
    channel.bind('App\\Events\\KudosAddedEvent', data => {
      if(data.kudo.length > 0){
        this.kudosInfo.unshift(data.kudo[0].kudos[0]);
      }
    });
  },

  methods:{
    newKudo(){
      this.$router.push('/board/kudo');
    }
  }
}
</script>
<style>
  .gaps{
    gap:.75rem;
  }

  .board-info{
    background-color: #2c3e50;
    color:#fff;
    padding: 2rem;
    border-radius: 1rem;
  }

  .board-kudos{
    background-color: #f7f1e3;
    color:#2c3e50;
    padding: 1.5rem;
    border-radius: 1rem;
    margin-bottom: .30rem;
  }
</style>
