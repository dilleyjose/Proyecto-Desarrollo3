<template>   
      <div>
        <b-row>   
            <b-col cols="4">
                <b-card>
                    <div>

                        <b-row>
                          <b-col lg="12" class="my-1">   
                            <b-form-group 
                              label="Filtrar"
                              label-cols-sm="3"
                              label-align-sm="right"
                              label-size="sm"
                              class="mb-0"
                              label-for="filter">
                              
                              <b-input-group>
                                <b-form-input 
                                  class="text-center "
                                  id="filter"
                                  type="text"
                                  size="sm"
                                  v-model="querySearch"
                                  placeholder="Buscar....">               
                                </b-form-input>

                                <b-input-group-append>
                                  <b-button 
                                    :disabled="!querySearch" 
                                    @click="querySearch = ''"
                                    size="sm">
                                      Clear
                                    </b-button>
                                </b-input-group-append>

                              </b-input-group>

                            </b-form-group>
                          </b-col>

                          <b-col cols="3"></b-col>
<!--
                          <b-col lg="3" class="my-1" align="right" >  
                            <b-button 
                              @click="modalShow = !modalShow"
                              size="sm" 
                              variant="success"
                              style="width: 100%;">
                              Nuevo
                            </b-button>

                            <b-modal 
                              v-model="modalShow" 
                              size="lg" 
                              title="Agregar Item"
                              :hide-footer="true">
                              <invoice-form
                                @add="addItem(...arguments)"/>
                            </b-modal>
                          </b-col> 
-->
                        </b-row>   

                        <b-row>
                          <b-col lg="12" class="my-1">
                            <b-form-group
                              label="Registros"
                              label-cols-sm="6"
                              label-cols-md="4"
                              label-cols-lg="3"
                              label-align-sm="right"
                              label-size="sm"
                              label-for="perPageSelect"
                              class="mb-0">

                              <b-form-select 
                                v-model="perPage"
                                id="perPageSelect"
                                size="sm"
                                :options="pageOptions">
                              </b-form-select>
                            </b-form-group>
                          </b-col>

                          <b-col cols="3"></b-col>

                          <b-col lg="3" class="my-1" align="right"></b-col> 
                        </b-row>  

                        <b-row>
                          <b-col lg="12" class="my-1">
                            <b-pagination
                              v-model="currentPage"
                              :total-rows="totalRows"
                              :per-page="perPage"
                              align="fill"
                              size="sm"
                              class="my-0">
                            </b-pagination>
                          </b-col>
                        </b-row>

                        <b-table  
                          striped 
                          hover 
                          :items="items"  
                          :fields="fields"
                          :filter="querySearch"     
                          :current-page="currentPage"
                          :per-page="perPage"
                          @filtered="onFiltered">
                          
                          <template v-slot:cell(actions)="row" align="center">

                            <b-row>
                              <b-col cols="8">
 
                                <invoice-option-add-item
                                  :invoice = "invoice"
                                  :item = "row.item"
                                  @addItemInvoice="addItemInvoice(row.index , ...arguments)"/>

                              <!--
                                <div>  
                                  <b-button 
                                    class="my-1 mx-2"
                                    @click="modalShow = !modalShow"
                                    size="sm" 
                                    variant="info"
                                    style="width: 100%;position: relative;">
                                    +
                                  </b-button>
                                  <b-modal 
                                    v-model="modalShow" 
                                    size="lg" 
                                    title="Agregar Producto"
                                    :hide-footer="true">
                                    <invoice-form
                                      :item="row.item"
                                      :invoice="invoice"
                                      @addItemInvoice="addItemInvoice(...arguments)"/>
                                  </b-modal>
                                </div>  
                              -->
                              </b-col>
                            </b-row> 
                              
                          </template>
                        </b-table>
                    </div>
                </b-card>   
            </b-col>

            <!--Panel Derecho-->
            <b-col cols="8">
                 
                <b-card>
                    <b-row>    
                        <b-col cols="9">

                            <b-table  
                              striped 
                              hover 
                              :items="itemsInvoice"  
                              :fields="fields2">
<!--
                              <template v-slot:cell(name)="row" align="center">
                                <b-row>
                                  <b-col cols="8">
                                    {{ row.item.product_name }}
                                  </b-col>
                                </b-row> 
                              </template>
-->
                              <template v-slot:cell(total)="row" align="center">
                                <b-row>
                                  <b-col cols="8">
                                    {{ row.item.amount * row.item.quantity }}
                                  </b-col>
                                </b-row> 
                              </template>
                              
                              <template v-slot:cell(actions)="row" align="center">
                                <b-row>
                                  <b-col cols="6">
                                    <invoice-option-delete-item
                                      :item = "row.item"
                                      @deleteItemInvoice=
                                        "deleteItemInvoice(
                                            row.item.quantity, 
                                            row.item.product_index, 
                                            row.index )"/>
                                  </b-col>
                                </b-row>    
                              </template>
                            </b-table>

                        </b-col>

                        <b-col cols="3">
                            <h6>Cliente:</h6> <h5>{{ invoice.client_name }}</h5>
                            <h6>Factura Nro:</h6> <h3>{{ invoice.id }}</h3>
                            <h6>TOTAL:</h6> <h3>{{ totalAmount }}</h3>
                        </b-col>

                    </b-row>
                </b-card>    
            </b-col>

        </b-row>
    </div>  
</template>

<script>
  export default {
    props:{
      invoice: Object,
      user: Object
    },
    data() {
      return {
        itemsInvoice: [],
        items: [],  
        fields: [ 
                  { key: 'name', label: 'Nombre' } ,
                  { key: 'amount', label: 'Precio' } ,
                  { key: 'actions', label: 'Acciones' } ,  
                ],
        fields2: [ 
                  { key: 'product_name', label: 'Nombre' } ,
                  { key: 'amount', label: 'Precio' } ,
                  { key: 'quantity', label: 'Cant' } ,
                  { key: 'total', label: 'Total' } ,
                  { key: 'actions', label: 'Acciones' } ,  
        ],        
        querySearch:"",
        currentPage: 1,
        perPage: 5,
        pageOptions: [5, 10, 15],
        totalRows: 0,
        modalShow: false, 
        hide: true ,
        form: {
          name: '',
          description: '',
          amount: 0,
          stock: 0,
          quantity: 0,
        },
        show: true,
        totalAmount:0,   
      }
    },
    mounted() {
      this.getItems()
      console.log(this.invoice)
    },
    methods:{
      onFiltered(filteredItems) {
        // Trigger pagination to update the number of buttons/pages due to filtering
        this.totalRows = filteredItems.length
        this.currentPage = 1
      },
      getItems(){
        axios.get("products/api").then((response) => {
          this.items = response.data

          // Set the initial number of items
          this.totalRows = this.items.length

          this.querySearch = " "
        });
      },
      addItemInvoice(product_index, item){
          this.items[product_index].stock -= item.quantity  
          item.product_index = product_index
          console.log("addItem");
          console.log(item);
          this.itemsInvoice.push(item)
          this.modalShow = false
          this.totalRows++

          this.totalAmount = parseFloat( this.totalAmount)
          item.amount = parseFloat( item.amount )        
          this.totalAmount += (item.amount  * item.quantity)

          
            
          console.log("Se Ejecuto addItemInvoice")

          this.makeToast(
            "Notificacion",
            "Elemento Agregado a Factura",
            "success")     
      },
      updateItem(index,item_data){
        if( !this.querySearchInUse() ){
          this.items[index].name = item_data.name
          this.items[index].stock = item_data.stock
          this.items[index].description = item_data.description
          this.items[index].amount = item_data.amount         
        }else{
          this.getItems()
        }
        this.makeToast(
          "Notificacion",
          "Elemento Actualizado con Exito",
          "success")
      },
      deleteItemInvoice(quantity, product_index , index_item){
          //this.totalAmount = parseFloat( this.totalAmount)
          this.itemsInvoice[index_item].amount = parseFloat( this.itemsInvoice[index_item].amount )        
          this.totalAmount -= ( this.itemsInvoice[index_item].amount * this.itemsInvoice[index_item].quantity)
          

          this.items[product_index].stock = parseInt(this.items[product_index].stock);
          quantity = parseInt(quantity);

          this.items[product_index].stock += quantity

          const target = this.getTarget(index_item)
          this.itemsInvoice.splice(target, 1)
          this.totalRows--

        this.makeToast(
          "Notificacion",
          "Elemento Eliminado con Exito",
          "success")
      },
      getTarget(index){
        return ((this.currentPage * this.perPage) - this.perPage ) + index
      },
      querySearchInUse(){
        return !(this.querySearch == " " || this.querySearch == "")
      },

    }, 
  }
</script>