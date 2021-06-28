<template>
  <div>
    <b-row>
      <b-col cols="4">
        <product-option-update
          :item = "item"
          @update="updateEmit( ...arguments)"/>
      </b-col>  
      <b-col cols="4">
        <product-option-delete
          :itemID ="item.id"
          @delete="$emit('delete')" />
      </b-col>
    </b-row>
  </div>
</template>

<script>
  export default {
    props:{
      item: Object
    },
    methods:{
      updateEmit(item_data){
        this.$emit('update',item_data);
      }
    }    
  }
</script>