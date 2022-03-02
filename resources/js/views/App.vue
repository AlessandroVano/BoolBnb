<template>
  <div>
      <Header />
      <main>
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

<style>

</style>