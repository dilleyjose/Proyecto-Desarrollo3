<template>
  <div>
    <b-form @submit.prevent="onClicksubmitFunction()" @reset="onReset" v-if="show">
      
      <b-form-group
        label="Nombre Completo:"
        description="Nombre del Usuario">
        <b-form-input
          v-model="form.name"
          required
          placeholder="Nombre Complero">    
        </b-form-input>
      </b-form-group>

      <b-form-group 
        label="Email:"
        description="Email del Usuario">
        <b-form-input
          v-model="form.email"
          required
          placeholder="Email">    
        </b-form-input>
      </b-form-group>

      <b-form-group
        label="Descripcion:"
        description="Descripcion del Proveedor">
        <b-form-input
          v-model="form.description"
          required
          placeholder="Descripcion">    
        </b-form-input>
      </b-form-group>

      <b-form-group
        label="Direccion:"
        description="Direccion del usuario">
        <b-form-input
          v-model="form.address"
          required
          placeholder="Direccion">    
        </b-form-input>
      </b-form-group>

      <b-form-group
        label="Telefono:"
        description="Telefono del Usuario">
        <b-form-input
          v-model="form.phone"
          required
          placeholder="Telefono">    
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
          email: '',
          description: '',
          phone: '',
          address: '',
        },

        show: true,
      }
    },
    mounted(){
      if(this.item){
        this.form.name = this.item.name;
        this.form.email = this.item.email;
        this.form.description = this.item.descripcion;
        this.form.phone = this.item.phone;
        this.form.address = this.item.address;
      }
    },
    methods: {
      onReset(evt) {
        evt.preventDefault()

        this.form.name = '';
        this.form.email = ''; 
        this.form.description = ''; 
        this.form.phone = ''; 
        this.form.address = '';        
      },
      addItem(){
        const params = {
          name: this.form.name,
          email: this.form.email,
          description: this.description,
          phone: this.form.phone,
          address: this.form.address,

        };
        axios.post("clients/api" , params).then((response) => {
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
          email: this.form.email,
          description: this.form.description,
          phone: this.form.phone,
          address: this.form.address,

        };
        axios.put("clients/api/"+this.item.id , params).then((response) => {
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