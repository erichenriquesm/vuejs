<template>

  <site-template>

    <span slot="menuesquerdo">
          <div class="row valign-wrapper">
            <div class="col s2">
              <img src="https://avatars.githubusercontent.com/u/102707728?v=4" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
            </div>
            <div class="col s10">
              <span class="black-text">
                This is a square image. Add the "circle" class to it to make it appear circular.
              </span>
            </div>
          </div>
    </span>

      <span slot="principal">
        <div>
          <publicar-conteudo-vue/>
          <card-conteudo-vue perfil="https://avatars.githubusercontent.com/u/102707728?v=4" nome="Eric SM"
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

    }
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
