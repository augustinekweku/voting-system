<template>
    <div class=" my-3 admin-voters container animate__animated animate__fadeIn">
        <div class="d-flex justify-content-between">
        <div>
            <h2 class="font-weight-light">Voters</h2>
        </div>
        <div>
        <b-button id="show-btn" variant="success" @click="$bvModal.show('my-modal')">Add Voter</b-button>
        <!-- MODAL FOR ADDING VOTERS -->
                <b-modal ref="my-modal" id="my-modal" hide-footer>
                    <template #modal-title>
                    Add Voter
                    </template>
                    <div>
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1">First Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="form.firstName"
                                />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Last Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="form.lastName"
                                />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    v-model="form.email"
                                />
                            </div>
                            <div class="form-group">
                                <label for="role">Choose role</label>
                                    <select v-model="selectedRole" @change="setRole" class="custom-select">
                                    <option selected>Choose Role </option>
                                    <option v-for="role in roles" :key="role.id" :value="role.id">{{role.roleName}}</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone number</label>
                                <input
                                    type="phone"
                                    class="form-control"
                                    v-model="form.phone"
                                />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    v-model="form.password"
                                />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Confirm Password</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    v-model="form.confirmPassword"
                                />
                            </div>

                    <b-button class="mt-3" variant="success"   @click="addUser">Add</b-button>
                        </form>
                    </div>
                </b-modal>
        </div>
        </div>
        
        <div class="candidates_table my-3">
            <vue-good-table
            :line-numbers="true"
            :columns="columns"
            :rows="rows"/>
        </div>
    </div>
</template>

<script>
export default {
  name: 'admin-voters',
  data(){
    return {
        form: {
            firstName: '',
            lastName: '',
            email: '',
            phone: '',
            role_id: null,
            password: '',
            confirmPassword: ''
        },
        selectedRole: null,
      columns: [
        {
          label: 'Firstname',
          field: 'firstName',
        },
        {
          label: 'Lastname',
          field: 'firstName',
        },
        {
          label: 'Email',
          field: 'email',
        },
        {
          label: 'Phone',
          field: 'phone',
        },
        {
          label: 'Created on',
          field: 'created_at',
        },
      ],
      rows: [],
      roles:[]
    };
  },
  methods: {
      setRole(){
          this.form.role_id =  this.selectedRole
      },
      async addUser() {
			if (this.form.firstName.trim()=='') return this.warning('First name is required');
			if (this.form.lastName.trim()=='') return this.warning('Last name is required');
			if (this.form.email.trim()=='') return this.warning('Email is required');
			if (this.form.phone.trim()=='') return this.warning('Phone number is required');
			if (!this.form.role_id) return this.warning('Role is required');
			if (this.form.password.trim()=='') return this.warning('Password is required');
			if (this.form.confirmPassword !== this.form.password) return this.warning('Passwords do not match');
			if (this.form.password.length < 8) return this.warning('Password must be 8 or more characters');
            
            const res = await this.callApi('post', 'app/create_user', this.form)
			if (res.status === 201) {
				this.rows.unshift(res.data)
				this.success('Voter added successfully')
                this.$refs['my-modal'].hide()
				this.form.firstName = ''
				this.form.lastName = ''
				this.form.email = ''
				this.form.phone = ''
				this.form.password = ''
				this.form.confirmPassword = ''
				this.form.role_id = ''
			}else {
				if (res.status===422) {
					console.log(res.data.errors)
					for(let i in res.data.errors){
						this.warning(res.data.errors[i][0])
					}
					}else{
				this.warning('Something went wrong')
				}
			}
      },
        async getUsers(){
		const res = await this.callApi('get', 'app/get_users')
		if (res.status = 201) {
			this.rows = res.data
			console.log(res.data)
		}
        },

  },
  async created(){
      this.getUsers()
      
      //get roles
		const res = await this.callApi('get', 'app/get_roles')
		if (res.status = 201) {
            console.log(res.data)
            this.roles = res.data
		}

  }
};
</script>