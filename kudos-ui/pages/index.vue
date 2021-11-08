<template>
  <section class="section">
    <div class="container">
      <h1 class="title">Welcome, {{ this.$store.state.user.firstname }}</h1>
      <p>Here you have our available boards.</p>
    </div>
    <boards-list></boards-list>

  </section>
</template>
<script>
import KudosList from '../components/BoardsList.vue';
export default {
  components: { KudosList },
  middleware: 'auth',
  async mounted(){
    console.log(this.$store.state);
  }
}
</script>
