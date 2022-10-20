<template>
  <login-template>
    <span slot="principal">
      <h2>Cadastro</h2>
        <input type="text" name="nome"  placeholder="Digite seu nome">

        <input type="email" name="E-mail"  placeholder="Digite seu email">

        <input type="password" name="Senha"  placeholder="Digite sua senha">

        <input type="password" name="Senha"  placeholder="Confirme sua senha">

        <button type="button" class="btn col s4">Enviar</button>

        <router-link to="/login" style="margin-left: 5px;" class="btn blue col s7">Ja tenho</router-link>
    </span>

    <span slot="menuesquerdo">
      <img style="width: 100%; margin-top: 10px;" src="https://www.wsitebrasil.com.br/sig/www/openged/blog/34/000034_5ad4ef1093728_redessociaislogicadigital.jpg"  alt="">
    </span>
      
  </login-template>

</template>

<script>
import LoginTemplate from '@/templates/LoginTemplate'

export default {
  name: 'Cadastro',
  data() {
    return {

    }
  },
  components: {
    LoginTemplate
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  input::placeholder{
    color: black;
  }


</style>
