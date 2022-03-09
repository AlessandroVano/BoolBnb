<template>
  <div class="d-flex flex-column">
      <Header />
      <main class="flex-grow-1">
          <router-view></router-view>
      </main>
      <Footer />
  </div>
</template>

<script>
import Header from '../components/Header';
import Footer from '../components/Footer';
import Bootstrap from "../bootstrap.js";

export default {
  name: 'App',
  components: {
    Header,
    Footer,
    Bootstrap,
  }
}
</script>

<style scoped lang="scss">

</style>