<template>
  <site-template>
    <span slot="principal">
      <h2>Perfil</h2>
      <input type="text" name="nome" placeholder="Digite seu nome" v-model="name">

      <input type="email" name="E-mail" placeholder="Digite seu email" v-model="email">

      <div class="file-field input-field">
        <div class="btn">
          <span>Imagem</span>
          <input type="file" v-on:change="salvaImagem">
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text">
        </div>
      </div>

      <input type="password" name="Senha" placeholder="Digite sua senha" v-model="password">

      <input type="password" name="Senha" placeholder="Confirme sua senha" v-model="password_confirmation">

      <button v-on:click="perfil()" type="button" class="btn col s6">Atualizar</button>

    </span>

    <span slot="menuesquerdo">
      <img style="width: 100%; margin-top: 10px;"
        :src="usuario.imagem"
        alt="">
    </span>

  </site-template>

</template>

<script>
import SiteTemplate from '@/templates/SiteTemplate'
import axios from 'axios'

export default {
  name: 'Perfil',
  data() {
    return {
      usuario: false,
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
      imagem: '',
    }
  },
  components: {
    SiteTemplate
  },
  created() {
    let usuarioAux = sessionStorage.getItem('usuario');
    if (usuarioAux) {
      this.usuario = JSON.parse(usuarioAux);
      this.name = this.usuario.name;
      this.email = this.usuario.email;
    }
  },
  methods: {
    salvaImagem(e){
      let arquivo = e.target.files || e.dataTransfer.files;
      if(!arquivo.length){
        return;
      }
      let reader = new FileReader();
      reader.onload = (e) => {
        this.imagem = e.target.result;
      };

      reader.readAsDataURL(arquivo[0]);
      
    },
    perfil() {
      axios.put('http://127.0.0.1:8000/api/perfil', {name: this.name,
         email: this.email,
         imagem: this.imagem,
         password: this.password,
         password_confirmation: this.password_confirmation
        }, {"headers": {"authorization": "Bearer "+ this.usuario.token}})
        .then(response => {
          if (response.data.token) {
            console.log(response)
            this.usuario = response.data;
            sessionStorage.setItem('usuario', JSON.stringify(response.data));
            alert('Perfil atualizado!');
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
