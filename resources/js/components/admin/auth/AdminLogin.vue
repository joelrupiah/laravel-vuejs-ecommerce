<template>
    <div id="admin-login" class="hold-transition login-page">
        <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Admin</b>   Login</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form action="" method="post" @submit.prevent="adminLogin()">
                <div class="input-group mb-3">
                <input type="email" name="email" class="form-control" v-model="form.email" placeholder="Email">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                    </div>
                </div>
                </div>
                <span class="text-danger" v-if="errors['email']">
                    {{errors['email'][0]}}
                </span>

                <div class="input-group mb-3">
                <input type="password" name="password" class="form-control" v-model="form.password" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                    </div>
                </div>
                </div>
                <span class="text-danger" v-if="errors['password']">
                    {{errors['password'][0]}}
                </span>
                <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                    <input type="checkbox" id="remember">
                    <label for="remember">
                        Remember Me
                    </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
                <!-- /.col -->
                </div>
            </form>
            </div>
            <!-- /.login-card-body -->
        </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'AdminLogin',
    data() {
        return {
            errors: {},
            form: {

            }
        }
    },
    methods: {
        adminLogin(){
            axios.post('/admin/login', this.form)
                .then(res=>{
                    localStorage.setItem('adminLoggedIn', JSON.stringify(res.data))
                    this.$router.push({name: 'AdminDashboard'})
                    console.log(res)
                })
                .catch(err=>{
                    this.errors = err.response.data.errors
                })
        }
    }
}
</script>

<style>

</style>