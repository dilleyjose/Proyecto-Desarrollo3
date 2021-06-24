
require('./bootstrap');

window.Vue = require('vue');
window.eventBus = new Vue();

import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);

Vue.component('alert-component', require('./components/generalComponents/alertComponent.vue').default);

// *** COMPONENTES DE CONTROL DE usersES ***
Vue.component('users-component', require('./components/usersComponents/usersComponent').default);
Vue.component('users-tablet', require('./components/usersComponents/usersTablet.vue').default);
//Vue.component('users-details', require('./components/userssComponents/usersDetailsComponent').default);
Vue.component('user-form', require('./components/usersComponents/userFormComponent').default);
Vue.component('user-option-cell', require('./components/usersComponents/userOptionsCellTable.vue').default);
Vue.component('user-option-delete', require('./components/usersComponents/userOptionDelete.vue').default);
Vue.component('user-option-update', require('./components/usersComponents/userOptionUpdate.vue').default);


Vue.mixin({
  methods: {
   	alertUp: function (message, variant, dismissSecs) {
    	const alertData =  [];
    	alertData['message'] = message;
        alertData['variant'] = variant;
        alertData['dismissSecs'] = dismissSecs;

        eventBus.$emit('showAlert',alertData);
	},
	makeToast: function (title = "Notificacion",text = "Texto" ,variant = null) {
        this.$bvToast.toast(text, {
          title: title,
          variant: variant,
          solid: true
        })
    },
  }
})

const app = new Vue({
    el: '#app',
    methods:{

    },
});
