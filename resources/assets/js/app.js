
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Axios from 'axios';
import './bootstrap';

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app',
   data: {
        msg: 'Hey, been trying to meet you',
        content: '',
        posts: [], 
    },

    ready: function() {
        this.created();
    },

    created() {
        axios.get('http://localhost/TheMySpot/index.php/posts')
        .then(resposta => {
            console.log(resposta);
            this.posts = resposta.data;//mostra se funfou
        })
        .catch(function(error) {
            console.log(error);//mostra se não funfou
        });
    },

    methods:{

        addPost() {

            //alert('test function');
            axios.post('http://localhost/TheMySpot/index.php/addPost', {
                content: this.content
            })
            .then(function(resposta) {
                console.log('Salvo corretamente');//mostra se funfou
                if(resposta.status === 200) {
                //alert('Seu post foi adicionado');
                app.posts = resposta.data;
                }
            })
            .catch(function(error) {
                console.log(error);//mostra se não funfou
            });
        }
    }
});
