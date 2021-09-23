<template>
    <div
        class=" my-3 admin-candidates container animate__animated animate__fadeIn"
    >
        <div class="d-flex justify-content-between">
            <div>
                <h2 class="font-weight-light">Roles</h2>
            </div>
            <div>
                <!-- MODAL FOR ADDING ROLES -->

                <b-modal id="modal-1" title="Add Role">
                    <div>
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="exampleInputEmail1"
                                    aria-describedby="emailHelp"
                                />
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </form>
                    </div>
                </b-modal>

                <b-button id="show-btn" variant="success" @click="$bvModal.show('my-modal')">Add Role</b-button>

                <b-modal ref="my-modal" id="my-modal" hide-footer>
                    <template #modal-title>
                    Add role
                    </template>
                    <div>
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="roleName"
                                />
                            </div>

                    <b-button class="mt-3" variant="success"   @click="addRole">Add</b-button>
                        </form>
                    </div>
                </b-modal>
            </div>
        </div>
        <div class="d-flex justify-content-center">
        <div class="roles_table my-3">
            <vue-good-table :line-numbers="true" :columns="columns" :rows="rows" />
        </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "my-component",
    data() {
        return {
            roleName: '',
            roles:[],
            columns: [
                {
                    label: "Role Name",
                    field: "roleName",
                    type: "number"
                },
                {
                    label: "Created On",
                    field: "created_at",
                }
            ],
            rows: [
            ]
        };
    },
    methods: {
        async getRoles(){
		const res = await this.callApi('get', 'app/get_roles')
		if (res.status = 201) {
			this.rows = res.data
			console.log(res.data)
		}
        },
        async addRole(){
        if (this.roleName === '') { return this.warning('Role name is required')}
            axios
        .post(`app/create_role/${this.roleName}`)
        .then(result => {
            console.log(result);
            if (result.status == 201) {
                this.success('Role Added Successfully')
                this.$refs['my-modal'].hide()
                this.getRoles()
            }else{
                return this.info('something went wrong')
            }
        })
        .catch(err => {
            console.log(err);
        });


        }
    },
	async created() {
        this.getRoles()
	},
};
</script>
