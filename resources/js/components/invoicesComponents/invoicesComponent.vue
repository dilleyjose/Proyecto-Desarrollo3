<template>   
    <b-card class="my-0">
        <template v-slot:header>
            <h4 class="mb-0">Facturas</h4>
        </template>
        <b-row>  
            <b-col cols="12">
                <b-card>
                    <invoice-select-client v-if="modeComponent === 'selectClient'"
                        :user="user"
                        @changeMode="changeMode(...arguments)"
                    />
                    <invoice-select-items v-else-if="modeComponent === 'selectItems'"
                        :invoice="invoiceSelected"
                    />
                </b-card>   
            </b-col>                    
        </b-row>
    </b-card>   
</template>

<script>
  export default {
    props:{
        user: Object,
    },
    data() {
      return {
        modeComponent:"selectClient",   
        invoiceSelected: Object 
      }
    },
    methods:{
      changeMode(invoice) {
        console.log("Se ejecuto changeMode")
        this.invoiceSelected = invoice
        this.modeComponent = "selectItems"

      },
    },
  }
</script>