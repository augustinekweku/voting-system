<template>
 

    <div class="login-card mt-3  d-flex justify-content-center animate__animated animate__fadeIn">
                    <div class="py-2 px-4" >
                        <h5 class="text-center font-weight-light py-2">Please enter the OTP sent to your number: <br> 
                            {{phone}}
                        </h5>
                        <form>
                        <div class="row">
                            <div class="col-2">
                                <input @keyup="nextInput(0)" v-model="digit1" maxlength="1" class="code_input" type="text">
                            </div>
                            <div class="col-2">
                                <input @keyup="nextInput(1)" v-model="digit2" maxlength="1" class="code_input" type="text">
                            </div>
                            <div class="col-2">
                                <input @keyup="nextInput(2)" v-model="digit3" maxlength="1" class="code_input" type="text">
                            </div>
                            <div class="col-2">
                                <input @keyup="nextInput(3)" v-model="digit4" maxlength="1" class="code_input" type="text">
                            </div>
                            <div class="col-2">
                                <input @keyup="nextInput(4)" v-model="digit5" maxlength="1" class="code_input" type="text">
                            </div>
                            <div class="col-2">
                                <input  class="code_input" v-model="digit6"  maxlength="1" type="text">
                            </div>
                        </div>
                            <b-overlay
                            :show="busy"
                            rounded
                            opacity="0.6"
                            spinner-small
                            spinner-variant="primary"
                            class="d-inline-block"
                            @hidden="onHidden"
                            >
                    <b-button class="mt-3" ref="button"  variant="success"   @click="verifyCode">Verify</b-button>
                    </b-overlay>
                    <p v-if="isCodeRequested" class="py-2 animate__animated animate__fadeIn"> <i> Didn't get receive the code? </i> <a @click="requestCode"> Request Code again</a></p>
                        </form>
                    </div>
  </div>

</template>

<script>

export default {
props:['phone'],
  components: {
  },
  data() {
    return {
        inputs: [],
        digit1: '',
        digit2: '',
        digit3: '',
        digit4: '',
        digit5: '',
        digit6: '',
        busy: false,
        isCodeRequested:false
        };
  },
  methods: {
      requestCode(){
            axios
            .post(`app/request_code/${this.phone}`)
            .then(result => {
                console.log(result);
            })
            .catch(err => {
                console.log(err);
            });
      },
      verifyCode(){
          if (this.digit1 === ''){return this.warning('invalid verification code')}
          if (this.digit2 === ''){return this.warning('invalid verification code')}
          if (this.digit3 === ''){return this.warning('invalid verification code')}
          if (this.digit4 === ''){return this.warning('invalid verification code')}
          if (this.digit5 === ''){return this.warning('invalid verification code')}
          if (this.digit6 === ''){return this.warning('invalid verification code')}
          let code = this.digit1 + this.digit2 + this.digit3 + this.digit4 + this.digit5 + this.digit6
          console.log(code)
            this.$Progress.start()
            this.busy = true
            axios
            .post(`app/verify/${this.phone}/${code}`)
            .then(result => {
                console.log(result);
                if (result) {
                    this.success('Signed in Successfully')
                    window.location = '/'
                    this.$Progress.finish()
                    this.busy = false
                }else{
                    this.$Progress.finish()
                    return this.info('Incorrect Code')
                }
            })
            .catch(err => {
                console.log(err);
            });
      },
      nextInput(i){
          let inputs = document.getElementsByClassName('code_input');
              inputs[i+1].focus();

},
      onHidden() {
        // Return focus to the button
        this.$refs.button.focus()
      },
      showRequestAgainButton(){
          this.isCodeRequested = true
          console.log('hello')
      }
},
        created() {
                setTimeout(this.showRequestAgainButton(), 4000);
                console.log(' verify')
      }
}
</script>

<style  scoped>

.code_input{
    width: 45px;
    line-height: 35px;
    border-radius: 5px;
    font-size: 20px;
    border: black solid 1px;
    padding: 10px;

}

.btn{
    background: green;
}

#app {
  margin: 0 0;
}
.intro {
  background: rgb(14, 97, 111);
  background: linear-gradient(
    90deg,
    rgba(14, 97, 111, 1) 0%,
    rgba(64, 191, 159, 1) 100%,
    rgba(19, 162, 147, 1) 100%
  );
  color: white;
}
.main-page {
  margin-left: 30% !important;
  position: relative;
}
 .login .register_intro__inner {
margin-top: 0 ;
padding-top: 20px;
}

</style>
