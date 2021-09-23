<template>
    <div class=" my-3 admin-candidates container animate__animated animate__fadeIn">
        <div class="d-flex justify-content-between">
        <div>
            <h2 class="font-weight-light">Candidates</h2>
        </div>
        <div>
        <b-button v-b-modal.modal-1  variant="success">Button</b-button>
        <!-- MODAL FOR ADDING CANDIDATES -->

                    <b-modal id="modal-1" title="Add Candidate">
                        <div>
                            <form>
                <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input  type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Nickname</label>
                <input   type="text" class="form-control" id="exampleInputPassword1">
                </div>

                <div class="form-group">
                <label for="exampleFormControlSelect1">Aspiring Postion</label>
                <select class="form-control" id="exampleFormControlSelect1">
                <option >
                        </option>
                
                </select>

            </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
                    </div>
    </b-modal>
        </div>
        </div>
        
        <div class="candidates_table my-3">
            <vue-good-table
            :columns="columns"
            :rows="rows"/>
        </div>
    </div>
</template>

<script>
export default {
  name: 'my-component',
  data(){
    return {
      columns: [
        {
          label: 'Name',
          field: 'name',
        },
        {
          label: 'Age',
          field: 'age',
          type: 'number',
        },
        {
          label: 'Created On',
          field: 'createdAt',
          type: 'date',
          dateInputFormat: 'yyyy-MM-dd',
          dateOutputFormat: 'MMM do yy',
        },
        {
          label: 'Percent',
          field: 'score',
          type: 'percentage',
        },
      ],
      rows: [
        { id:1, name:"John", age: 20, createdAt: '2011-10-31',score: 0.03343 },
        { id:2, name:"Jane", age: 24, createdAt: '2011-10-31', score: 0.03343 },
        { id:3, name:"Susan", age: 16, createdAt: '2011-10-30', score: 0.03343 },
        { id:4, name:"Chris", age: 55, createdAt: '2011-10-11', score: 0.03343 },
        { id:5, name:"Dan", age: 40, createdAt: '2011-10-21', score: 0.03343 },
        { id:6, name:"John", age: 20, createdAt: '2011-10-31', score: 0.03343 },
      ],
    };
  },
};
</script>