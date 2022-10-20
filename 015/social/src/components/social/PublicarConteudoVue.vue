<template>
    <div class="row">
      <grid-vue class="input-field " tamanho="12">
        <textarea v-model="dados" class="materialize-textarea"></textarea>
        <label>O que está acontecendo?</label>
      </grid-vue>
      <p v-if="dados">
        <grid-vue class="btn waves-effect waves-light" tamanho="3 offset-s9">Publicar</grid-vue>
      </p>
      <slot/>
    </div>
</template>

<style scpode>

</style>

<script>
    import GridVue from '@/components/layouts/GridVue'
    export default{
        name: 'PublicarConteudoVue',
        components:{
            GridVue
        },
        data(){
            return{
                dados: ''
            }
        }
    }
</script>