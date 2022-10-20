<template>

<span>
  <div v-if="img" class="card-image">
    <img :src="img ||'http://materializecss.com/images/sample-1.jpg'">
    <span class="card-title">{{title || ''}}</span>
  </div>

  <div v-if="txt" class="card-content">
    <p>{{txt}}</p>
  </div>
</span>

</template>

<script>
import GridVue from '@/components/layouts/GridVue'

export default {
  name: 'CardDetalhesVue',
  props: ['txt', 'title', 'img'],
  data () {
    return {

    }
  },
  components:{
    GridVue
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
