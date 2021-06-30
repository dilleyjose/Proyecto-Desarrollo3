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
      invoice: Object,
    },
    data() {
      return {
        form: {
          quantity: 0,
        },

        show: true,
      }
    },
    mounted(){

    },
    methods: {
      onReset(evt) {
        evt.preventDefault()
        this.form.quantity = 0;         
      },
      addItemInvoice(){
        if(this.StockValidation(this.form.quantity,this.item.stock)){
          const params = {
            invoice_id: this.invoice.id,
            product_id: this.item.id,
            quantity: this.form.quantity,
            amount: this.item.amount
          };
          axios.post("invoiceItems/api" , params).then((response) => {
            const item_data = response.data;
            this.$emit('addItemInvoice',item_data);

          },() => {
            this.makeToast(
              "Notificacion",
              "Hubo un problema",
              "danger");          
          });
        }  
      },
      onClicksubmitFunction(){
          this.addItemInvoice();
      },
      StockValidation(quantity , stock){
        if( quantity > stock ){
          console.log("cantidad es mayor a stock")
          console.log("quantity:"+quantity)
          console.log("stock:"+stock)
          this.makeToast(
            "Notificacion",
            "Stock no Suficiente",
            "danger");
          return false
        }else{
          console.log("cantidad es menor a stock")
          console.log("quantity:"+quantity)
          console.log("stock:"+stock)
          return true
        }
      }
    }
  }
</script>