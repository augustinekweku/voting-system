<template>
  <div>
  <div v-if="!$store.state.user" class="login">
    <!-- START OF INTRO JUMBOTRON -->
    <div class="intro">
      <div class="intro__inner container pb-5">
        <h1 class="font-weight-light mt-4">CCHN - Winneba</h1>
        <p class="font-weight-light">College of Community Health Nursing</p>
        <p class="font-weight-lighter">2020/2021 Academic Year Elections</p>
      </div>


    </div>
    <!-- END OF INTRO JUMBOTRON -->

    <div class="login-card mt-3  d-flex justify-content-center">
        <div class=" py-2 px-4 card w-30">
            <h2 class="text-center font-weight-normal">Login</h2>
            <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input v-model="form.email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input v-model="form.password" type="password" class="form-control" id="exampleInputPassword1">
            </div>
                            <b-overlay
                            :show="busy"
                            rounded
                            opacity="0.6"
                            spinner-small
                            spinner-variant="primary"
                            class="d-inline-block"
                            >
                    <b-button class="mt-3 btn-login" ref="button"  variant="success"   @click="login">Login</b-button>
                            </b-overlay>
                    <b-button class="mt-3"   variant="link"   to="/register">Not registered? Sign up!</b-button>
                            
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

        form: {
          email: '',
          password: '',
        },
        busy: false

    };
  },
  methods: {
            async login() {

			if (this.form.email.trim()=='') return this.warning('Email is required');
			if (this.form.password.trim()=='') return this.warning('Password is required');
	
            
            const res = await this.callApi('post', 'app/login', this.form)
            this.busy = true
            this.$Progress.start()
                console.log(res)
                            
            if (res.status == 200) {
            this.busy = false
            this.$Progress.finish()
            this.success(res.data.msg)
            window.location = '/'
              }else{
                if (res.status === 401) {
                this.$Progress.fail()
                this.error(res.data.msg)
                this.busy = false
                }else if (res.status === 422) {
                this.$Progress.fail()
                this.busy = false
                for(let i in res.data.errors){
                  this.error(res.data.errors[i][0])
					      }    
                }
                else{
                this.$Progress.fail()
                this.busy = false
                    this.error('something went wrong')
                }
            }
            
            
			
      }
  },
  created() {

  },
};
</script>

<style  scoped>

.btn-login{
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
 .login .intro__inner {
margin-top: 0;
padding-top: 20px;
}

</style>
