<template>
  <div>  
    <b-button 
      class="my-1 mx-2"
      @click="modalShow = !modalShow"
      size="sm" 
      variant="info"
      style="width: 100%;position: relative;">
      +
    </b-button>
    <b-modal 
      v-model="modalShow" 
      size="lg" 
      title="Agregar Producto"
      :hide-footer="true">
      <invoice-form
        :item="item"
        @addItemInvoice="addItemInvoiceEmit(...arguments)"/>
    </b-modal>
  </div>
</template>

<script>
  export default {
    props:{
      item: Object 
    },
    data() {
      return {
        modalShow: false, 
      }
    },
    methods:{
      addItemInvoiceEmit(item_data){
        this.modalShow = false;
        this.$emit('addItemInvoice',item_data);
      }
    }, 
  }
</script>