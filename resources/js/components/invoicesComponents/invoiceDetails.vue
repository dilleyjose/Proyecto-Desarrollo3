<template>
  <div>
    <h5>Productos:</h5>
    <ul v-for="item in items">
      <li>
        <p>Producto: {{ item.name }}</p>
        <p>Cantidad: {{ item.quantity }}</p>
        <p>Precio: {{ item.amount }}</p>
        <p>Total: {{ item.quantity * item.amount }}</p>
      </li>
    </ul>
  </div>  
</template>

<script>
  export default {
    props:{
      invoiceID: Number,
    },
    data() {
      return {
        items: [],   
      }
    },
    mounted() {
      this.getProducts()
    },
    methods:{
      getProducts(){
        axios.get("api/getProducts/"+this.invoiceID).then((response) => {
          this.items = response.data
        });
      },
    }
        
  }
</script>
