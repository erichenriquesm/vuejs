<template>
  <login-template>
    <span slot="principal">
      <h2>Cadastro</h2>
      <input type="text" name="nome" placeholder="Digite seu nome" v-model="name">

      <input type="email" name="E-mail" placeholder="Digite seu email" v-model="email">

      <input type="password" name="Senha" placeholder="Digite sua senha" v-model="password">

      <input type="password" name="Senha" placeholder="Confirme sua senha" v-model="password_confirmation">

      <button @click="cadastrar()" type="button" class="btn col s6">Cadastre</button>

      <router-link to="/login" style="margin-left: 5px;" class="btn blue col s5">Ja tenho</router-link>
    </span>

    <span slot="menuesquerdo">
      <img style="width: 100%; margin-top: 10px;"
        src="https://www.wsitebrasil.com.br/sig/www/openged/blog/34/000034_5ad4ef1093728_redessociaislogicadigital.jpg"
        alt="">
    </span>

  </login-template>

</template>

<script>
import LoginTemplate from '@/templates/LoginTemplate'
import axios from 'axios'

export default {
  name: 'Cadastro',
  data() {
    return {
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
    }
  },
  components: {
    LoginTemplate
  },
  methods: {
    cadastrar() {
      axios.post('http://127.0.0.1:8000/api/cadastro', { name: this.name, email: this.email, password: this.password, password_confirmation: this.password_confirmation })
        .then(response => {
          if(response.data.token){
            alert('Cadastro efetuado com sucesso');
            sessionStorage.setItem('usuario', JSON.stringify(response.data));
            this.$router.push('/');
          }else if(response.data.status === false){
            alert('Erro ao se cadastrar')
          }else{
            let log = ''
            for(let erro of Object.values(response.data)){
              log += erro + ' ';
            }
            alert(log);
          }
        })

        .catch(error => {
          console.log(error);
        });
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
input::placeholder {
  color: black;
}
</style>
