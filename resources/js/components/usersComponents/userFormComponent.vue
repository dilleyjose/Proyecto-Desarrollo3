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
        label="Cedula:"
        description="Cedula del Usuario">
        <b-form-input
          v-model="form.identity_card"
          required
          placeholder="Cedula">    
        </b-form-input>
      </b-form-group>

      <b-form-group
        label="Direccion:"
        description="Direccion del usuario">
        <b-form-input
          v-model="form.addres"
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

      <b-form-group
        label="Cargo:"
        description="Cargo del Usuario">
        <b-form-input
          v-model="form.position"
          required
          placeholder="Cargo">    
        </b-form-input>
      </b-form-group>

      <b-form-group
        label="Role:"
        description="Role del usuario">
        <b-form-input
          v-model="form.role"
          required
          placeholder="role">    
        </b-form-input>
      </b-form-group>

      <b-form-group
        label="Contreseña:"
        description="PassWord del Usuario">
        <b-form-input
          v-model="form.password"
          required
          placeholder="Contraseña">    
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
          identity_card: '',
          phone: '',
          addres: '',
          role: '',
          password: '',
        },
        show: true,
      }
    },
    mounted(){
      if(this.item){
        this.form.name = this.item.name;
        this.form.email = this.item.email;
        this.form.identity_card = this.item.identity_card;
        this.form.phone = this.item.phone;
        this.form.addres = this.item.addres;
        this.form.role = this.item.role;
        this.form.password = this.item.password;
      }
    },
    methods: {
      onReset(evt) {
        evt.preventDefault()

        this.form.name = '';
        this.form.email = ''; 
        this.form.identity_card = ''; 
        this.form.phone = ''; 
        this.form.addres = ''; 
        this.form.role = ''; 
        this.form.password = '';         
      },
      addItem(){
        const params = {
          name: this.form.name,
          email: this.form.email,
          identity_card: this.form.identity_card,
          phone: this.form.phone,
          addres: this.form.addres,
          role: this.form.role,
          password: this.form.password,
        };
        axios.post("users/api" , params).then((response) => {
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
          identity_card: this.form.identity_card,
          phone: this.form.phone,
          addres: this.form.addres,
          role: this.form.role,
          password: this.form.password
        };
        axios.put("users/api/"+this.item.id , params).then((response) => {
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