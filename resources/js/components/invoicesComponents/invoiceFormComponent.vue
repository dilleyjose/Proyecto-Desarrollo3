<template>
  <div>
    <b-form @submit.prevent="onClicksubmitFunction()" @reset="onReset" v-if="show">
      
      <div v-if="item" >
        <p><strong>Nombre:</strong> {{ item.name }}</p>
        <p><strong>Descripcion:</strong> {{ item.description }}</p>
        <p><strong>Inventario:</strong> {{ item.stock }}</p>
        <p><strong>Precio:</strong> {{ item.amount }}</p>
      </div>  

      <b-form-group
        label="Cantidad:"
        description="Cantidad de Productos a Agregar">
        <b-form-input
          v-model="form.quantity"
          type="number"
          required
          placeholder="Nombre">    
        </b-form-input>
      </b-form-group>

      <b-button
        type="submit"
        variant="primary">
        Enviar
      </b-button>

      <b-button 
        type="reset" 
        variant="danger">
        Reset
      </b-button>
    </b-form>

  </div>
</template>

<script>
  export default {
    props:{
      item: Object,
    },
    data() {
      return {
        form: {
          name: '',
          description: '',
          amount: 0,
          stock: 0,
          quantity: 0,
        },

        show: true,
      }
    },
    mounted(){
      if(this.item){
        this.form.name = this.item.name;
        this.form.description = this.item.description;
        this.form.amount = this.item.amount;
        this.form.stock = this.item.stock;
      }
    },
    methods: {
      onReset(evt) {
        evt.preventDefault()
        this.form.name = '';
        this.form.description = '';
        this.form.amount = ''; 
        this.form.stock = '';         
      },
      /*
      addItem(){
        const params = {
          name: this.form.name,
          description: this.form.description,
          amount: this.form.amount,
          stock: this.form.stock,

        };
        axios.post("products/api" , params).then((response) => {
          const item = response.data;
          this.$emit('add',item);   
        },() => {
          this.makeToast(
            "Notificacion",
            "Hubo un problema",
            "danger");          
        });
      },
      */
      addItemInvoice(){
        const params = {
          name: this.form.name,
          description: this.form.description,
          amount: this.form.amount,
          stock: this.form.stock,
        };
        /*
        axios.put("products/api/"+this.item.id , params).then((response) => {
          const item_data = response.data;
          this.$emit('update',item_data);
        },() => {
          this.makeToast(
            "Notificacion",
            "Hubo un problema",
            "danger");
        });
        */
        this.$emit('addItemInvoice',params);
      },
      onClicksubmitFunction(){
          this.addItemInvoice();
      }
    }
  }
</script>