<template lang="">
  <section class="section">
    <div class="container">
      <div class="columns is-vcentered is-justify-content-space-between">
        <nuxt-link to="/">< Return to the boards list</nuxt-link>
        <b-button @click="newKudo" type="is-dark">New Kudo</b-button>
      </div>
      <div class="columns is-desktop is-multiline mt-2">
        <div class="column is-4">
          <div class="board-info">
            <p><h2 class="title is-4 is-white">{{ this.$store.state.boardInfo.board_title }}</h2></p>
            <p class="subtitle is-5 is-grey">{{ this.$store.state.boardInfo.board_description }}</p>
          </div>
        </div>
        <div class="column is-8">
          <div class="board-kudos" v-for="kudo in this.$store.state.kudosInfo">
            <h5 class="title is-5 is-dark mb-0">{{ kudo.firstname }} {{ kudo.lastname }}</h5>
            <p>
              {{ kudo.description }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
export default {
  middleware: 'auth',
  data() {
    return {
      board: [],
      kudos: [],
    }
  },

  async asyncData({ app, params, store }) {
    const token = 'Bearer ' + store.state.token;
    const response = await app.$axios.get(`http://localhost/api/boards/${params.id}`, {
      headers:{
        'Authorization': token
      }
    });
    const board = response.data[0].board;
    const kudos = response.data[0].kudos;
    store.commit('setBoardInfo', board);
    store.commit('setKudosInfo', kudos);
  },

  async mounted(){

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
