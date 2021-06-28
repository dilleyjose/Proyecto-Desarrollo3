<template>   
    <b-card class="my-0">
        <template v-slot:header>
            <h4 class="mb-0">Productos</h4>
        </template>
        <b-row>  
            <b-col cols="12">
                <b-card>
                    <products-tablet/>
                </b-card>   
            </b-col>                    
        </b-row>
    </b-card>   
</template>

<script>
  export default {

  }
</script>