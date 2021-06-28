<template>
  <div>  
    <b-button 
      class="my-1 mx-2"
      @click="modalShow = !modalShow"
      size="sm" 
      variant="danger"
      style="width: 100%;position: relative;">
      -
    </b-button>

    <b-modal 
      v-model="modalShow" 
      size="sm" 
      okVariant="danger">
      
      <template v-slot:modal-title>
        Eliminar Registro
      </template>

      <template v-slot:default>
        Esta Seguro que desea eliminar el registro?
      </template>

      <template v-slot:modal-footer>
        <b-col>
          <b-button 
            class="mx-0"
            @click="deleteItemInvoice"
            size="sm" 
            variant="danger"
            style="width: 100%;">
            eliminar
          </b-button>              
        </b-col>

        <b-col>
          <b-button 
            class="mx-0"
            @click="modalShow = !modalShow"
            size="sm" 
            variant="secondary"
            style="width: 100%;">
            cancelar
          </b-button>
        </b-col>
      </template> 
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
      deleteItemInvoice(){
        /*
        axios.delete("destinations/api/" + this.itemID).then(() => {
          this.$emit('delete');
        },() => {
          this.makeToast(
            "Notificacion",
            "Hubo un problema",
            "danger");
        });
        */
        const item_data = this.item;
        this.modalShow = false;
        this.$emit('deleteItemInvoice');
      }
    }    
  }
</script>