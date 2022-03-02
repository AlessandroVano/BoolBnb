console.log('FRONT OFFICE'); 


/* IMPORTAZIONE DI VUE */
import Vue from 'vue';

/* IMPORTAZIONE APP.VUE */
import App from './views/App.vue'

// IMPORTAZIONE ROTTE APP
import router from './routes';

// QUI METTIAMO L'ISTANZA DI VUE

const root = new Vue({
    // NODO CHE PORTIAMO DA
     el: '#root',  

    router,

    render: h => h(App)
})