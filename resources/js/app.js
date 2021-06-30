
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
Vue.component('user-options-cell', require('./components/usersComponents/userOptionsCellTable.vue').default);
Vue.component('user-option-delete', require('./components/usersComponents/userOptionDelete.vue').default);
Vue.component('user-option-update', require('./components/usersComponents/userOptionUpdate.vue').default);

Vue.component('clients-component', require('./components/clientsComponents/clientsComponent').default);
Vue.component('clients-tablet', require('./components/clientsComponents/clientsTablet.vue').default);
Vue.component('client-form', require('./components/clientsComponents/clientFormComponent').default);
Vue.component('client-options-cell', require('./components/clientsComponents/clientOptionsCellTable.vue').default);
Vue.component('client-option-delete', require('./components/clientsComponents/clientOptionDelete.vue').default);
Vue.component('client-option-update', require('./components/clientsComponents/clientOptionUpdate.vue').default);

Vue.component('suppliers-component', require('./components/suppliersComponents/suppliersComponent').default);
Vue.component('suppliers-tablet', require('./components/suppliersComponents/suppliersTablet.vue').default);
Vue.component('supplier-form', require('./components/suppliersComponents/supplierFormComponent').default);
Vue.component('supplier-options-cell', require('./components/suppliersComponents/supplierOptionsCellTable.vue').default);
Vue.component('supplier-option-delete', require('./components/suppliersComponents/supplierOptionDelete.vue').default);
Vue.component('supplier-option-update', require('./components/suppliersComponents/supplierOptionUpdate.vue').default);

Vue.component('products-component', require('./components/productsComponents/productsComponent').default);
Vue.component('products-tablet', require('./components/productsComponents/productsTablet.vue').default);
Vue.component('product-form', require('./components/productsComponents/productFormComponent').default);
Vue.component('product-options-cell', require('./components/productsComponents/productOptionsCellTable.vue').default);
Vue.component('product-option-delete', require('./components/productsComponents/productOptionDelete.vue').default);
Vue.component('product-option-update', require('./components/productsComponents/productOptionUpdate.vue').default);

Vue.component('invoices-component', require('./components/invoicesComponents/invoicesComponent.vue').default);
Vue.component('invoice-select-items', require('./components/invoicesComponents/invoiceSelectItems.vue').default);
Vue.component('invoice-form', require('./components/invoicesComponents/invoiceFormComponent').default);
Vue.component('invoice-option-add-item', require('./components/invoicesComponents/invoiceOptionAddItem.vue').default);
Vue.component('invoice-option-delete-item', require('./components/invoicesComponents/invoiceOptionDeleteItem.vue').default);
Vue.component('invoice-select-client', require('./components/invoicesComponents/invoiceSelectClient.vue').default);
Vue.component('invoice-option-create', require('./components/invoicesComponents/invoiceOptionCreate.vue').default);
Vue.component('invoices-tablet', require('./components/invoicesComponents/invoiceTablet.vue').default);


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
