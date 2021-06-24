<template>
  <div>
    <b-alert
      :fade=true
      :show="dismissCountDown"
      dismissible
      :variant="variant"
      @dismissed="dismissCountDown=0"
      @dismiss-count-down="countDownChanged">

      <h5>{{ message }}</h5>   
      <p>esta alerta se cerrara en {{ dismissCountDown }} segundos...</p>
      
      <b-progress
        :variant="variant"
        :max="dismissSecs"
        :value="dismissCountDown"
        height="4px">    
      </b-progress>
    </b-alert>
  </div>
</template>

<script>
  export default {

    data() {
      return {
        message: 'algo',
        variant: 'primary',
        dismissSecs: 10,
        dismissCountDown: 0,
        showDismissibleAlert: false,
        fade: true,
      }
    },
    mounted() {
      const self = this
      eventBus.$on('showAlert', function(data){
        self.message = data['message'] 
        self.variant = data['variant']
        self.dismissSecs = data['dismissSecs']
        self.showAlert()
      });
    },
    methods: {
      countDownChanged(dismissCountDown) {
        this.dismissCountDown = dismissCountDown
      },
      showAlert() {
        this.dismissCountDown = this.dismissSecs
      },
    }
  }
</script>