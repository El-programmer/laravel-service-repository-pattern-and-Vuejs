<template>
  <div class="card">
    <div class="card-header d-flex justify-content-between">
      Featured
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Add New
      </button>
    </div>
    <div class="card-body">
      <table class="table">
        <thead class="thead-light">
        <tr>
          <th scope="col">#</th>
          <th scope="col">name</th>
          <th scope="col">total</th>
          <th scope="col">daily_budget</th>
          <th scope="col">Date</th>
          <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
          <tr v-if="list.length == 0">
            <td rowspan="6" colspan="6" class="text-center">
              No Data
            </td>
          </tr>
          <tr v-for="(item , i) in list">
            <td>{{i}}</td>
            <td>{{item.name}}</td>
            <td>{{item.total}}</td>
            <td>{{item.daily_budget}}</td>
            <td>
              <div>{{item.from}}</div>
              <div>{{item.to}}</div>
            </td>
            <td>
              <a class="btn btn-sm btn-info">
                edit
              </a>
              <a class="btn btn-sm btn-danger">
                Remove
              </a>

            </td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
  <div class="modal" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" v-if="index = -1"> Create New </h5>
          <h5 class="modal-title" v-else> Edit </h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" @submit.prevent="save" id="form-item">
            <div class="form-group">
              <label for="exampleFormControlInput1">Name </label>
              <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>

            <div class="row row-cols-1 row-cols-md-2">
              <div class="form-group">
                <label >From</label>
                <input type="date" v-model="form.from" class="form-control" >
              </div>
              <div class="form-group">
                <label >to</label>
                <input type="date" v-model="form.to" class="form-control" >
              </div>

              <div class="form-group">
                <label >daily budget</label>
                <input type="number" v-model="form.daily_budget"  class="form-control" >
              </div>
              <div class="form-group">
                <label >total </label>
                <input type="number"  v-model="form.total" class="form-control" >
              </div>

            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="form-item" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
export default {
name: "campaigns",
  data(){
    return {
      list:[],
      form:{},
      index:-1,
    }
  },
  created() {
    axios
        .get('/api/dashboard/campaign')
        .then(response => (this.list = response.data))
        .catch(error => console.log(error))
  },
  methods:{
    editItem(index){
      this.index = index;
      this.form = this.list[index];
    },
    save(){
      console.log(this.form)
    }
  }
}
</script>

<style scoped>

</style>