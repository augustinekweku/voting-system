<template>
    <div class=" my-3 admin-voters container animate__animated animate__fadeIn">
        <div class="d-flex justify-content-between">
            <div>
                <h2 class="font-weight-light">Positions</h2>
            </div>
            <div>
                <b-button
                    id="show-btn"
                    variant="success"
                    @click="$bvModal.show('my-modal')"
                    >Add Aspiring Position</b-button
                >
                <!-- MODAL FOR ADDING POSITIONS -->
                <b-modal ref="my-modal" id="my-modal" hide-footer>
                    <template #modal-title>
                        Add Position
                    </template>
                    <div>
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1"
                                    >Position Name</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="form.position_name"
                                />
                            </div>
                            <b-button
                                class="mt-3"
                                variant="success"
                                @click="addPosition"
                                >Add</b-button
                            >
                        </form>
                    </div>
                </b-modal>

                <!-- MODAL FOR EDITING POSITIONS -->
                <b-modal
                    ref="editPositionModal"
                    id="editPositionModal"
                    hide-footer
                >
                    <template #modal-title>
                        Edit Position
                    </template>
                    <div>
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1"
                                    >Position Name</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="editData.position_name"
                                />
                            </div>
                            <div
                                class="action-buttons d-flex justify-content-between"
                            >
                                <div>
                                    <b-button
                                        class="mt-3"
                                        size="sm"
                                        variant="success"
                                        @click="editPosition"
                                        >Edit</b-button
                                    >
                                </div>
                                <div>
                                    <b-button
                                        class="mt-3"
                                        size="sm"
                                        variant="danger"
                                        @click="deletePosition"
                                        >Delete</b-button
                                    >
                                </div>
                            </div>
                        </form>
                    </div>
                </b-modal>
            </div>
        </div>

        <div class="candidates_table my-3">
            <vue-good-table
                :line-numbers="true"
                :columns="columns"
                :rows="rows"
                @on-row-click="onRowClick"
            />
        </div>
    </div>
</template>

<script>
import Swal from "sweetalert2";
export default {
    name: "admin-voters",
    data() {
        return {
            form: {
                position_name: ""
            },
            editData: {
                position_name: ""
            },
            columns: [
                {
                    label: "Position Name",
                    field: "position_name"
                },
                {
                    label: "Created on",
                    field: this.dateFn,
                    html: true
                }
            ],
            rows: [],
            roles: [],
            selectedIndex: null
        };
    },
    methods: {
        dateFn(RowObj) {
            //return RowObj
            let d = new Date(RowObj.created_at);
            let date = d.toDateString();
            return date;
        },
        async deletePosition() {
            Swal.fire({
                title: "Are you sure you want to delete?",
                showCancelButton: true,
                confirmButtonText: "Delete"
            }).then(async result => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    const res = await this.callApi(
                        "post",
                        "app/delete_position",
                        this.editData
                    );
                    if (res.status == 200) {
                        this.getPositions();
                        this.$refs["editPositionModal"].hide();
                        this.editData.position_name = "";
                    }
                    console.log(res.data);
                }
            });
        },
        onRowClick(params) {
            let obj = {
                id: params.row.id,
                position_name: params.row.position_name
            };
            this.selectedIndex = params.row.id;
            this.editData = obj;
            this.$refs["editPositionModal"].show();
        },
        async addPosition() {
            if (this.form.position_name.trim() == "")
                return this.warning("Position name is required");

            const res = await this.callApi(
                "post",
                "app/create_position",
                this.form
            );
            if (res.status === 201) {
                this.rows.unshift(res.data);
                this.success("Position added successfully");
                this.$refs["my-modal"].hide();
                this.form.position_name = "";
            } else {
                if (res.status === 422) {
                    console.log(res.data.errors);
                    for (let i in res.data.errors) {
                        this.warning(res.data.errors[i][0]);
                    }
                } else {
                    this.warning("Something went wrong");
                }
            }
        },
        async editPosition() {
            if (this.editData.position_name.trim() == "")
                return this.warning("Position name is required");

            const res = await this.callApi(
                "post",
                "app/edit_position",
                this.editData
            );
            if (res.status === 200) {
                this.getPositions();
                this.success("Position updated successfully");
                this.$refs["editPositionModal"].hide();
                this.editData.position_name = "";
            } else {
                if (res.status === 422) {
                    console.log(res.data.errors);
                    for (let i in res.data.errors) {
                        this.warning(res.data.errors[i][0]);
                    }
                } else {
                    this.warning("Something went wrong");
                }
            }
        },
        async getPositions() {
            const res = await this.callApi("get", "app/get_positions");
            if ((res.status = 200)) {
                this.rows = res.data;
                console.log(res.data);
            }
        }
    },
    async created() {
        this.getPositions();
    }
};
</script>
