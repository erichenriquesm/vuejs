<template>
    <span>
      <header>
        <nav-bar logo="Social" url="/" cor="black">
          <li><router-link to="/">Home</router-link></li>
          <li><router-link to="/login">Entrar</router-link></li>
          <li><router-link to="/cadastro">Cadastre-se</router-link></li>
        </nav-bar>
      </header>
  
      <main>
        <div class="container">
          <div class="row">
            <grid-vue tamanho="5">
              <card-menu-vue>
                <slot name="menuesquerdo"/>
              </card-menu-vue>
             
            </grid-vue>

            <grid-vue tamanho="7">
              <slot name="principal" />
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
    name: 'SiteTemplate',
    components:{
      NavBar,
      FooterVue,
      GridVue,
      CardMenuVue
    }
  }
  </script>
  
  <style>
  
  </style>
  