require('./bootstrap');

import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue);

// *** COMPONENTES DE CONTROL DE usersES ***
Vue.component('users-component', require('./components/usersComponents/usersComponent').default);
Vue.component('users-table', require('./components/usersComponents/userstablet').default);
//Vue.component('users-details', require('./components/userssComponents/usersDetailsComponent').default);
Vue.component('user-form', require('./components/usersComponents/userFormComponent').default);
Vue.component('user-option-cell', require('./components/usersComponents/userOptionsCellTable.vue').default);
Vue.component('user-option-delete', require('./components/usersComponents/userOptionDelete.vue').default);
Vue.component('user-option-update', require('./components/usersComponents/usersOptionUpdate.vue').default);

const app = new Vue({
    el: '#app',
    methods:{

    },
});
