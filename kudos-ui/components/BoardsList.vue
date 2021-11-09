<template lang="">
  <section class="boards-list">
    <div class="container">
      <div class="columns is-desktop is-multiline gaps">
        <div @click="chooseBoard(board.id)" v-for="board in boards" class="column mb-4 board-item is-clickable">
          <div class="vertical-align">
            <h2 class="is-4"><b>{{ board.title }}</b></h2>
            <div class="is-6">{{ board.description }}</div>
            <div class="is-7">Number of Kudos: {{ board.count }}</div>
          </div>
        </div>
      </div>
    </div>
    <b-loading :is-full-page="isFullPage" v-model="isLoading" :can-cancel="false"></b-loading>
  </section>
</template>
<style>
  .boards-list{
    padding-top: 2rem;
  }

  .gaps{
    gap:.75rem;
  }

  .board-item{
    border:1px solid #2c3e50;
    color:#2c3e50;
    padding: 2rem;
    border-radius: 1rem;
    transition: .5s ease-in-out all;
  }

  .board-item:hover{
    background-color: #2c3e50;
    color:#fff !important;
    padding: 2rem;
    border-radius: 1rem;
  }

  .is-white{
    color:#fff;
  }

  .is-grey{
    color:#f1f2f6;
  }

  .is-7{
    font-size: .8rem;;
  }

  .vertical-align{
    display: flex;
    flex-direction: column;
    height: 100%;
    justify-content: space-between;
  }
</style>
<script>
export default {
  data() {
    return {
      boards: [],
      isLoading: false,
      isFullPage: true
    }
  },

  async mounted(){
    this.isLoading = true;
    const token = 'Bearer ' + this.$store.state.token;
    const response = await this.$axios.get('http://localhost/api/boards', {
      headers:{
        'Authorization': token
      }
    });
    this.isLoading = false;
    this.boards = response.data;
    if(response.data.status == "Token is Expired"){
      this.$store.commit('setUser', "");
      this.$store.commit('setToken', "");
      this.$router.push('/');
    }
  },

  methods:{
    async chooseBoard(id){
      this.isLoading = true;
      this.$store.commit('setSelectedBoard', id);
      this.$router.push(`/board/${id}`);
    }
  }
}
</script>
