<template>   
    <div>    
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

                          <b-col lg="3" class="my-1" align="right" >  
                            <b-button 
                              @click="modalShow = !modalShow"
                              size="sm" 
                              variant="success"
                              style="width: 100%;">
                              Crear Nuevo Cliente
                            </b-button>

                            <b-modal 
                              v-model="modalShow" 
                              size="lg" 
                              title="Nuevo Cliente"
                              :hide-footer="true">
                              <client-form
                                @add="addItem(...arguments)"/>
                            </b-modal>
                          </b-col>  
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
                            <b-row>
                              <b-col cols="4">
                                <invoice-option-create
                                  :userID = "user.id"
                                  :clientID = "row.item.id"
                                  @createInvoice="createInvoice(...arguments)"/>
                              </b-col>  
                            </b-row>  
                          </template>
                        </b-table>
                      </div>
                </b-card>   
            </b-col>                    
        </b-row>
    </div>      
</template>

<script>
  export default {
    props:{
        user: Object,
        //csrfToken: String
    },
    data() {
      return {
        items: [],  
        fields: [ 
                  { key: 'name', label: 'Nombre' } ,
                  { key: 'identity_card', label: 'Cedula' } ,
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
      this.getItems();
      console.log(this.user);
    },
    methods:{
      onFiltered(filteredItems) {
        // Trigger pagination to update the number of buttons/pages due to filtering
        this.totalRows = filteredItems.length
        this.currentPage = 1
      },
      getItems(){
        axios.get("clients/api").then((response) => {
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
      createInvoice(invoice){
        console.log("Se ejecuto createInvoice")
        this.$emit('changeMode',invoice);
        this.makeToast(
          "Notificacion",
          "Elemento Agregado con Exito",
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