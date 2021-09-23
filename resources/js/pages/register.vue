<template>
  <div >
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

    <div  class="login-card mt-3  d-flex justify-content-center">
                    <div class="py-2 px-4 card animate__animated animate__fadeIn">
                      <h3 class="font-weight-light text-center py-3">Register</h3>
                        <form>
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="form.firstName"
                                />
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="form.lastName"
                                />
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <template>
                                  <vue-tel-input validCharactersOnly mode="international" v-model="form.phone"></vue-tel-input>
                                </template>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    v-model="form.email"
                                />
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    v-model="form.password"
                                />
                            </div>
                            <div class="form-group">
                                <label for="password2">Confirm Password</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    v-model="form.confirmPassword"
                                />
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
                    <b-button class="mt-3 btn-login" ref="button" variant="success"   @click="addUser">Register</b-button>
                            </b-overlay>
                    <b-button class="mt-3"   variant="link"   to="/login">Already registered? Log in!</b-button>

                    <div>
                    <a v-if="isCodeRequested" class="float-right"  style="cursor:pointer;" @click="$bvModal.show('my-modal')"><i class="font-weight-light">verify Phone number</i></a>
                    </div>
                        </form>
                    </div>
  </div>
    <b-modal no-close-on-backdrop ref="my-modal" id="my-modal" hide-footer>
    <verify :isCodeRequested="isCodeRequested" :phone="form.phone"></verify>
    </b-modal>
    </div>
  </div>







</template>

<script>

export default {
  components: {
  },
  data() {
    return {
        form: {
            firstName: '',
            lastName: '',
            email: '',
            phone: '',
            password: '',
            confirmPassword: ''
        },
        selectedRole: null,
        roles:[],
        busy: false,
        isCodeRequested: false


        
    };
  },
  methods: {
      async addUser() {

          if (this.form.firstName.trim()=='') return this.warning('First name is required');
			if (this.form.lastName.trim()=='') return this.warning('Last name is required');
			if (this.form.email.trim()=='') return this.warning('Email is required');
			if (this.form.phone.trim()=='') return this.warning('Phone number is required');
			if (this.form.password.trim()=='') return this.warning('Password is required');
			if (this.form.confirmPassword !== this.form.password) return this.warning('Passwords do not match');
      if (this.form.password.length < 8) return this.warning('Password must be 8 or more characters');
            
            this.busy = true
            this.$Progress.start()
            const res = await this.callApi('post', 'app/create_user', this.form)
                console.log(res)
            if (res.status == 201) {
            this.busy = false
            this.$Progress.finish()
            this.$refs['my-modal'].show()
            this.isCodeRequested =  true             
                }else{
              if (res.status===422) {
                console.log(res.data.errors)
                  for(let i in res.data.errors){
                    this.error(res.data.errors[i][0])
                  }
                this.$Progress.fail()
                this.busy = false
            }else{
              this.$Progress.fail()
              this.busy = false
              this.swr()
            }
            } 
            
			
      },
        onHidden() {
        // Return focus to the button
        this.$refs.button.focus()
      },
  },
  async created() {

        
  },

};
</script>

<style  scoped>

.btn-login{
    background: green;
}
.card{
    box-shadow: 0px 0px 4px 0px rgba(0,0,0,0.48);
    top: -50px;
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
