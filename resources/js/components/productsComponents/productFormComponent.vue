<template>
  <div>
    <b-form @submit.prevent="onClicksubmitFunction()" @reset="onReset" v-if="show">
      
      <b-form-group
        label="Nombre:"
        description="Nombre del Producto">
        <b-form-input
          v-model="form.name"
          required
          placeholder="Nombre">    
        </b-form-input>
      </b-form-group>

      <b-form-group
        label="Descripcion:"
        description="Descripcion del Producto">
        <b-form-input
          v-model="form.description"
          required
          placeholder="Descripcion">    
        </b-form-input>
      </b-form-group>

      <b-form-group
        label="Stock:"
        description="Stock del Producto">
        <b-form-input
          v-model="form.stock"
          required
          placeholder="Stock">    
        </b-form-input>
      </b-form-group>

      <b-form-group
        label="Precio:"
        description="Precio del Producto">
        <b-form-input
          v-model="form.amount"
          required
          placeholder="Monto">    
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
      updateItem(){
        const params = {
          name: this.form.name,
          description: this.form.description,
          amount: this.form.amount,
          stock: this.form.stock,
        };
        axios.put("products/api/"+this.item.id , params).then((response) => {
          const item_data = response.data;
          this.$emit('update',item_data);
        },() => {
          this.makeToast(
            "Notificacion",
            "Hubo un problema",
            "danger");
        });
      },
      onClicksubmitFunction(){
        if(!this.item)
          this.addItem();  
        else
          this.updateItem();
      }
    }
  }
</script>