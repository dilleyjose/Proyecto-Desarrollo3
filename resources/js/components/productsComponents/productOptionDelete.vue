<template>
  <div>  
    <b-button 
      class="my-1 mx-2"
      @click="modalShow = !modalShow"
      size="sm" 
      variant="danger"
      style="width: 100%;position: relative;">
      Eliminar
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
            @click="deleteItem"
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
      itemID: Number 
    },
    data() {
      return {
        modalShow: false, 
      }
    },
    methods:{
      deleteItem(){
        axios.delete("products/api/" + this.itemID).then(() => {
          this.$emit('delete');
        },() => {
          this.makeToast(
            "Notificacion",
            "Hubo un problema",
            "danger");
        });
        this.modalShow = false;
      }
    }    
  }
</script>