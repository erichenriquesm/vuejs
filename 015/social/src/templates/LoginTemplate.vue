<template>
  <span>
    <header>
      <nav-bar logo="Social" url="/" cor="black">
        <li v-if="!usuario">
          <router-link to="/login">Entrar</router-link>
        </li>
        <li v-if="!usuario">
          <router-link to="/cadastro">Cadastre-se</router-link>
        </li>
        <li v-if="usuario">
          <router-link to="/perfil">{{usuario.name}}</router-link>
        </li>
        <li v-if="usuario"><a v-on:click="sair()">Sair</a></li>
      </nav-bar>
    </header>

    <main>
      <div class="container">
        <div class="row">
          <grid-vue tamanho="8">

            <slot name="menuesquerdo"></slot>


          </grid-vue>

          <grid-vue tamanho="4">
            <slot name="principal"></slot>
          </grid-vue>

        </div>



      </div>
    </main>

    <footer-vue cor="black" logo="Social" descricao="Teste de descrição" ano="2022">

      <li><a class="grey-text text-lighten-3" href="#!">Home</a></li>
      <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
      <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
      <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>

    </footer-vue>


  </span>
</template>
  
<script>
import NavBar from '@/components/layouts/NavBar'
import FooterVue from '@/components/layouts/FooterVue'
import GridVue from '@/components/layouts/GridVue'
import CardMenuVue from '@/components/layouts/CardMenuVue'

export default {
  name: 'LoginTemplate',
  components: {
    NavBar,
    FooterVue,
    GridVue,
    CardMenuVue
  },
  data() {
    return {
      usuario: false
    }
  },
  created() {
    console.log('created()');
    let usuarioAux = sessionStorage.getItem('usuario');
    if (usuarioAux) {
      this.usuario = JSON.parse(usuarioAux);
      this.$router.push('/')
    }
  },
  methods: {
    sair() {
      sessionStorage.clear();
      this.usuario = false;
    }
  }
}
</script>
  
<style>

</style>
  