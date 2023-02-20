<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Sign In</h5>
            <form autocomplete="off" @submit.prevent="sinin" method="post">
              <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="form.email" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" v-model="form.password" required>
              </div>
              <button type="submit" class="btn btn-default btn-secondary">Sign in</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import {mapActions} from "vuex";

export default {
name: "login",
  data(){
    return {
      form:{
        email:"",
        password:"",
      }
    }
  },
  methods:{
    ...mapActions({
      login:"auth/login"
    }),
    sinin: function () {
      this.login(this.form);
    }
  }
}
</script>

<style scoped>

</style>