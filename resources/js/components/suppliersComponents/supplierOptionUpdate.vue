<template>
  <div>  
    <b-button 
      class="my-1 mx-2"
      @click="modalShow = !modalShow"
      size="sm" 
      variant="info"
      style="width: 100%;position: relative;">
      Editar
    </b-button>
    <b-modal 
      v-model="modalShow" 
      size="lg" 
      title="Editar Registro"
      :hide-footer="true">
      <supplier-form
        :item="item"
        @update="updateEmit(...arguments)"/>
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
      updateEmit(item_data){
        this.modalShow = false;
        this.$emit('update',item_data);
      }
    }, 
  }
</script>