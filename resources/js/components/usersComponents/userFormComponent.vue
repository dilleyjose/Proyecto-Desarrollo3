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
        label="Privilegios:"
        description="Nivel de Acceso del Usuario">
        <b-form-select 
          v-model="form.role"
          :options="options" 
          size="sm" 
          class="mt-3">    
        </b-form-select>
      </b-form-group>

      <b-form-group
        label="Contraseña:"
        description="Contraseña del Usuario">
        <b-form-input
          v-model="form.password"
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
          address: '',
          position: '',
          role: 'user',
          password: '',
        },
        options: [
          { value: 'user', text: 'Usuario sin Privilegios de administrador' },
          { value: 'admin', text: 'Usuario con Privilegios de administrador' },
        ],
        show: true,
      }
    },
    mounted(){
      if(this.item){
        this.form.name = this.item.name;
        this.form.email = this.item.email;
        this.form.identity_card = this.item.identity_card;
        this.form.phone = this.item.phone;
        this.form.address = this.item.address;
        this.form.position = this.item.position;
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
        this.form.address = ''; 
        this.form.position = ''; 
        this.form.role = 'user'; 
        this.form.password = '';         
      },
      addItem(){
        const params = {
          name: this.form.name,
          email: this.form.email,
          identity_card: this.form.identity_card,
          phone: this.form.phone,
          address: this.form.address,
          position: this.form.position,
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
          address: this.form.address,
          position: this.form.position,
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