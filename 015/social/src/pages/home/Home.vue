<template>

  <site-template>

    <span slot="menuesquerdo">
          <div class="row valign-wrapper">
            <div class="col s4">
              <img :src="usuario.imagem" alt="" style="width:50px; margin-right: 20px;"  class="circle"> <!-- notice the "circle" class -->
            </div>
            <div class="col s8">
              <h5>{{usuario.name}}</h5>
            </div>
          </div>
    </span>

      <span slot="principal">
        <div>
          <publicar-conteudo-vue/>
          <card-conteudo-vue :perfil="usuario.imagem" :nome="usuario.name"
              data="08/10/22 01:15">
              <card-detalhes-vue title="Meu post" txt="Meu post dinâmico com vue js"
                img="https://images.ecycle.com.br/wp-content/uploads/2021/05/20195924/o-que-e-paisagem.jpg">
              </card-detalhes-vue>
          </card-conteudo-vue>
        </div>
      </span>
  </site-template>


  
</template>

<script>
import SiteTemplate from '@/templates/SiteTemplate'
import CardConteudoVue from '@/components/social/CardConteudoVue'
import CardDetalhesVue from '@/components/social/CardDetalhesVue'
import PublicarConteudoVue from '@/components/social/PublicarConteudoVue'
export default {
  name: 'Home',
  data() {
    return {
      usuario: null,
    }
  },
  created(){
    var usuarioAux = sessionStorage.getItem('usuario');
    var usuario = JSON.parse(usuarioAux);
    this.usuario = usuario;
  },
  components: {
    SiteTemplate,
    CardConteudoVue,
    CardDetalhesVue,
    PublicarConteudoVue
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
