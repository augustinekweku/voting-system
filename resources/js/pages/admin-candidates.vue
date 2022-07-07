<template>
    <div
        class=" my-3 admin-candidates container animate__animated animate__fadeIn"
    >
        <div class="d-flex justify-content-between">
            <div>
                <h2 class="font-weight-light">Candidates</h2>
            </div>
            <div>
                <b-button v-b-modal.modal-1 variant="success"
                    >Add Candidate</b-button
                >
                <!-- MODAL FOR ADDING CANDIDATES -->

                <b-modal id="modal-1" title="Add Candidate" hide-footer>
                    <div>
                        <form>
                            <div class="form-group">
                                <label for="profileImage">Profile Image</label>
                                <vue-upload-multiple-image
                                    @upload-success="uploadImageSuccess"
                                    @before-remove="beforeRemove"
                                    @edit-image="editImage"
                                    :data-images="images"
                                    idUpload="myIdUpload"
                                    editUpload="myIdEdit"
                                    popupText="default image"
                                    dragText="Drag Image and drop here"
                                    browseText="Browse"
                                    primaryText="File added"
                                    markIsPrimaryText="Set as default image"
                                    dropText="Drop file"
                                    :multiple="false"
                                ></vue-upload-multiple-image>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"
                                    >First Name</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="exampleInputEmail1"
                                    aria-describedby="emailHelp"
                                />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"
                                    >Last Name</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="exampleInputEmail1"
                                    aria-describedby="emailHelp"
                                />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1"
                                    >Nickname</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="exampleInputPassword1"
                                />
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1"
                                    >Aspiring Position</label
                                >
                                <select
                                    class="form-control"
                                    id="exampleFormControlSelect1"
                                >
                                    <option
                                        v-for="position in positions"
                                        :key="position.id"
                                    >
                                        {{ position.position_name }}</option
                                    >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1"
                                    >Political Party</label
                                >
                                <select
                                    class="form-control"
                                    id="exampleFormControlSelect1"
                                >
                                    <option
                                        v-for="party in parties"
                                        :key="party.id"
                                    >
                                        {{ party.party_name }}</option
                                    >
                                </select>
                            </div>

                            <div
                                class="action-buttons d-flex justify-content-between"
                            >
                                <div>
                                    <b-button
                                        class="mt-3"
                                        size="sm"
                                        variant="success"
                                        @click="handleSubmit"
                                        >Edit</b-button
                                    >
                                </div>
                                <div>
                                    <b-button
                                        class="mt-3"
                                        size="sm"
                                        variant="danger"
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
            <vue-good-table :columns="columns" :rows="rows" />
        </div>
    </div>
</template>

<script>
import VueUploadMultipleImage from "vue-upload-multiple-image";
import {
    getStorage,
    ref,
    uploadBytesResumable,
    getDownloadURL
} from "firebase/storage";
import app from "../firebase";
export default {
    name: "my-component",
    components: {
        VueUploadMultipleImage
    },
    data() {
        return {
            columns: [
                {
                    label: "Name",
                    field: "name"
                },
                {
                    label: "Age",
                    field: "age",
                    type: "number"
                },
                {
                    label: "Created On",
                    field: "createdAt",
                    type: "date",
                    dateInputFormat: "yyyy-MM-dd",
                    dateOutputFormat: "MMM do yy"
                },
                {
                    label: "Percent",
                    field: "score",
                    type: "percentage"
                }
            ],
            rows: [
                {
                    id: 1,
                    name: "John",
                    age: 20,
                    createdAt: "2011-10-31",
                    score: 0.03343
                },
                {
                    id: 2,
                    name: "Jane",
                    age: 24,
                    createdAt: "2011-10-31",
                    score: 0.03343
                },
                {
                    id: 3,
                    name: "Susan",
                    age: 16,
                    createdAt: "2011-10-30",
                    score: 0.03343
                },
                {
                    id: 4,
                    name: "Chris",
                    age: 55,
                    createdAt: "2011-10-11",
                    score: 0.03343
                },
                {
                    id: 5,
                    name: "Dan",
                    age: 40,
                    createdAt: "2011-10-21",
                    score: 0.03343
                },
                {
                    id: 6,
                    name: "John",
                    age: 20,
                    createdAt: "2011-10-31",
                    score: 0.03343
                }
            ],
            positions: [],
            parties: [],
            images: []
        };
    },
    methods: {
        beforeRemove(index, done, fileList) {
            console.log("index", index, fileList);
            var r = confirm("remove image");
            if (r == true) {
                done();
            } else {
            }
        },
        editImage(formData, index, fileList) {
            console.log("edit data", formData, index, fileList);
        },
        uploadImageSuccess(formData, index, fileList) {
            this.images = fileList;
            const fileName = new Date().getTime() + this.images[0].name;
            console.log(fileList);
            const storage = getStorage(app);
            const storageRef = ref(storage, fileName);
            const uploadTask = uploadBytesResumable(storageRef, formData);

            // Register three observers:
            // 1. 'state_changed' observer, called any time the state changes
            // 2. Error observer, called on failure
            // 3. Completion observer, called on successful completion
            uploadTask.on(
                "state_changed",
                snapshot => {
                    // Observe state change events such as progress, pause, and resume
                    // Get task progress, including the number of bytes uploaded and the total number of bytes to be uploaded
                    const progress =
                        (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                    console.log("Upload is " + progress + "% done");
                    switch (snapshot.state) {
                        case "paused":
                            console.log("Upload is paused");
                            break;
                        case "running":
                            console.log("Upload is running");
                            break;
                        default:
                    }
                },
                error => {
                    // Handle unsuccessful uploads
                },
                () => {
                    // Handle successful uploads on complete
                    // For instance, get the download URL: https://firebasestorage.googleapis.com/...
                    getDownloadURL(uploadTask.snapshot.ref).then(
                        downloadURL => {
                            console.log(
                                "File is available at : " + downloadURL
                            );
                        }
                    );
                }
            );
        },
        handleSubmit(e) {
            const fileName = new Date().getTime() + this.images[0].name;
            console.log(JSON.stringify(this.images[0]));
            const file = JSON.stringify(this.images[0]);
            const storage = getStorage(app);
            const storageRef = ref(storage, fileName);
            const uploadTask = uploadBytesResumable(storageRef, file);

            // Register three observers:
            // 1. 'state_changed' observer, called any time the state changes
            // 2. Error observer, called on failure
            // 3. Completion observer, called on successful completion
            uploadTask.on(
                "state_changed",
                snapshot => {
                    // Observe state change events such as progress, pause, and resume
                    // Get task progress, including the number of bytes uploaded and the total number of bytes to be uploaded
                    const progress =
                        (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                    console.log("Upload is " + progress + "% done");
                    switch (snapshot.state) {
                        case "paused":
                            console.log("Upload is paused");
                            break;
                        case "running":
                            console.log("Upload is running");
                            break;
                        default:
                    }
                },
                error => {
                    // Handle unsuccessful uploads
                },
                () => {
                    // Handle successful uploads on complete
                    // For instance, get the download URL: https://firebasestorage.googleapis.com/...
                    getDownloadURL(uploadTask.snapshot.ref).then(
                        downloadURL => {
                            console.log(
                                "File is available at : " + downloadURL
                            );
                        }
                    );
                }
            );
        },
        async getPositions() {
            const res = await this.callApi("get", "app/get_positions");
            if (res.status == 200) {
                this.positions = res.data;
            }
        },
        async getParties() {
            const res = await this.callApi("get", "app/get_parties");
            if (res.status == 200) {
                this.parties = res.data;
            }
        }
    },
    async created() {
        this.getPositions();
        this.getParties();
    }
};
</script>
