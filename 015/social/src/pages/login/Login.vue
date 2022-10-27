<template>
  <login-template>
    <span slot="principal">
        <h2>Login</h2>

        <input type="email" name="E-mail" id="email" placeholder="E-mail" v-model="email">

        <input type="password" name="Senha" id="senha" placeholder="Senha" v-model="password">

        <button v-on:click="login()" type="button" class="btn">Entrar</button>

        <router-link to="/cadastro" class="btn blue">Cadastre-se</router-link>
    </span>

    <span slot="menuesquerdo">
      <img style="width: 100%; margin-top: 10px;" src="https://www.wsitebrasil.com.br/sig/www/openged/blog/34/000034_5ad4ef1093728_redessociaislogicadigital.jpg"  alt="">
    </span>
      
  </login-template>

</template>

<script>
import LoginTemplate from '@/templates/LoginTemplate'
import axios from 'axios'
export default {
  name: 'Login',
  data() {
    return {
        email: '',
        password: ''
      }
    },
  components: {
    LoginTemplate
  },
  methods:{
    login(){
      axios.post('http://127.0.0.1:8000/api/login', {email: this.email, password: this.password})
        .then(response => {
          console.log(response)
          if(response.data.token){
            console.log('Login com sucesso');
            alert('Login efetuado')
            sessionStorage.setItem('usuario', JSON.stringify(response.data))
            this.$router.push('/');
          }else if(response.data.status == false){
            console.log('Login não existe');
            alert('Login inválido! senha ou email incorreto')
          }else{
            alert('Erro de validação');
          }
        })

        .catch(error => {
          alert('ERRO! Tente novamente mais tarde')
        })
      ;  
    }
  }
}

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  input::placeholder{
    color: black;
  }


</style>
