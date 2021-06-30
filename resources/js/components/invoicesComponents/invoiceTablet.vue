<template>   
    <b-card class="my-0">
        <template v-slot:header>
            <h4 class="mb-0">Facturas</h4>
        </template>
        <b-row>  
            <b-col cols="12">
                <b-card>
                  <div>
                      <b-row>
                        <b-col lg="6" class="my-1">   
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

                      </b-row>   

                      <b-row>
                        <b-col lg="6" class="my-1">
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
                        <b-col lg="6" class="my-1">
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
                          <product-options-cell
                            :item="row.item"
                            @delete="deleteItem(row.index)"
                            @update="updateItem(row.index, ...arguments)"/>        
                        </template>
                      </b-table>
                    </div>
                </b-card>   
            </b-col>                    
        </b-row>
    </b-card>   
</template>


<script>
  export default {
    data() {
      return {
        items: [],  
        fields: [ 
                  { key: 'id', label: 'Nro' }, 
                  { key: 'name', label: 'Nombre' } ,
                  { key: 'stock', label: 'Cantidad' } ,
                  { key: 'amount', label: 'Precio' } ,
                  { key: 'actions', label: 'Acciones' } ,  
                ],
        querySearch:"",
        currentPage: 1,
        perPage: 5,
        pageOptions: [5, 10, 15],
        totalRows: 0,
        modalShow: false, 
        hide: true    
      }
    },
    mounted() {
      this.getItems()
    },
    methods:{
      onFiltered(filteredItems) {
        // Trigger pagination to update the number of buttons/pages due to filtering
        this.totalRows = filteredItems.length
        this.currentPage = 1
      },
      getItems(){
        axios.get("api/getInvoices").then((response) => {
          this.items = response.data

          // Set the initial number of items
          this.totalRows = this.items.length

          this.querySearch = " "
        });
      },
      addItem(item){
        this.items.push(item)
        this.modalShow = false
        this.totalRows++

        this.makeToast(
          "Notificacion",
          "Elemento Agregado con Exito",
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
      deleteItem(index){
        if( !this.querySearchInUse() ){
          const target = this.getTarget(index)
          this.items.splice(target, 1)
          this.totalRows--
        }else{
          this.getItems()
        }
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
      }
    }, 
  }
</script>