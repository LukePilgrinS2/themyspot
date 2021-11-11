

import Axios from 'axios';
import './bootstrap';

window.Vue = require('vue');


Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app',
   data: {
        msg: 'Clique em um usuário do lado esquerdo:',
        content: '',  
        msgPrivada: [],
        msgSolo: [],
        msgFrom: [],
        conID: '',
        friend_id: '',
        seen: false,
        newMsgFrom: ''
    },

    ready: function() {
        this.created();
    },

    created() {
        axios.get('http://localhost/TheMySpot/index.php/getMensagens')
        .then(resposta => {
            console.log(resposta.data);
            app.msgPrivada = resposta.data;//mostra se funfou
        })
        .catch(function(error) {
            console.log(error);//mostra se não funfou
        });
    },

    methods:{

        mensagens: function(id) {
            
            axios.get('http://localhost/TheMySpot/index.php/getMensagens/' + id)
            .then(resposta => {
                console.log(resposta.data);
                app.msgSolo = resposta.data;//mostra se funfou
                app.conID = resposta.data[0].id_conversa
            })
            .catch(function(error) {
                console.log(error);//mostra se não funfou
            });
        },
        
        inputHandler(e) {
            if(e.keyCode === 13 && !e.shiftKey) {

            e.preventDefault();
            this.enviarMsg();
        }
    },
        enviarMsg() {
            
            if(this.msgFrom) {
                axios.post('http://localhost/TheMySpot/index.php/enviarMsg', {
                conID: this.conID,
                msg: this.msgFrom
            })
            .then(function(resposta) {
                console.log(resposta.data);//mostra se funfou

                if(resposta.status===200) {
                    app.msgSolo = resposta.data;
                }
            })
            .catch(function(error) {
                console.log(error);//mostra se não funfou
            });
            }
        },

        friendID: function(id) {
            app.friend_id = id;
        },
        enviarNovaMsg(){

            if(this.msgFrom) {
                axios.post('http://localhost/TheMySpot/index.php/enviarMsg', {
                conID: this.conID,
                msg: this.msgFrom
            })
            .then(function(resposta) {
                console.log(resposta.data);//mostra se funfou

                if(resposta.status===200) {
                    app.msgSolo = resposta.data;
                }
            })
            .catch(function(error) {
                console.log(error);//mostra se não funfou
            });
            }

            axios.post('http://localhost/TheMySpot/index.php/enviarNovaMsg', {
                friend_id: this.friend_id,
                msg: this.newMsgFrom,
            })
            .then(function(resposta) {
                console.log(resposta.data);//mostra se funfou

                if(resposta.status===200) {
                    window.location.replace('http://localhost/TheMySpot/index.php/mensagens');
                    app.msg = 'Sua mensagem foi enviada com sucesso';
                }
            })
            .catch(function(error) {
                console.log(error);//mostra se não funfou
            });    

        }
       
    
    }
});
