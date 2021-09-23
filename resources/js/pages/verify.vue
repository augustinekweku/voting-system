<template>
  <div v-if="isVerifyPage">
  <div class="register">
    <!-- START OF INTRO JUMBOTRON -->
    <div class="intro">
      <div class="register_intro__inner container pb-5">
        <h1 class="font-weight-light pt-4">CCHN - Winneba</h1>
        <p class="font-weight-light">College of Community Health Nursing</p>
        <p class="font-weight-lighter">2020/2021 Academic Year Elections</p>
      </div>


    </div>
    <!-- END OF INTRO JUMBOTRON -->

    <div class="login-card mt-3  d-flex justify-content-center">
                    <div class="py-2 px-4 card">
                        <h4 class="text-center font-weight-normal">Please enter the OTP sent to your number: <br> 
                            {{phone}}
                        </h4>
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Verification Code</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="verification_code"
                                />
                            </div>
                    <b-button class="mt-3" variant="success"   @click="verifyCode">Verify</b-button>
                        </form>
                    </div>
  </div>
    </div>
  </div>







</template>

<script>

export default {
    props:[],
  components: {
  },
  data() {
    return {
        isVerifyPage: false,
        verification_code: '',
        phone: ''
    };
  },
  methods: {
      verifyCode(){

      }
  },
  async created() {
      console.log(this.$route.name)
      if (this.$route.name === 'verify') {
          this.isVerifyPage = true

      }
  },
};
</script>

<style  scoped>

.btn{
    background: green;
}
.card{
    box-shadow: 0px 0px 4px 0px rgba(0,0,0,0.48);
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
