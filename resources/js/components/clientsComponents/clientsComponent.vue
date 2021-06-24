<template>   
    <b-card class="my-0">
        <template v-slot:header>
            <h4 class="mb-0">Clientes</h4>
        </template>
        <b-row>  
            <b-col cols="12">
                <b-card>
                    <clients-tablet/>
                </b-card>   
            </b-col>                    
        </b-row>
    </b-card>   
</template>

<script>
  export default {

  }
</script>