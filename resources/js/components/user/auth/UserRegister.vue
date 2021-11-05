<template>
    <div class="container">
			<!-- tittle heading -->
			<h3 class="tittle-w3l">Sign Up
                
				<span class="heading-style">
					<i></i>
					<i></i>
					<i></i>
				</span>
			</h3>
			<!-- //tittle heading -->
			<!-- contact -->
			<div class="contact agileits">
				<div class="contact-agileinfo">
					<div class="contact-form wthree">
						<form action="#" method="post" @submit.prevent="userRegister()">
							<div class="">
								<input type="text" v-model="form.name" placeholder="Name">
                                <span class="text-danger mb-2" v-if="errors['name']">{{errors['name'][0]}}</span>
							</div>
							<div class="">
								<input class="email" v-model="form.email" type="email" placeholder="Email">
                                <span class="text-danger" v-if="errors['email']">{{errors['email'][0]}}</span>
							</div>
							<div class="">
								<input class="text" v-model="form.phone" type="text" placeholder="Phone Number">
                                <span class="text-danger" v-if="errors['phone']">{{errors['phone'][0]}}</span>
							</div>
							<div class="">
								<input class="text" v-model="form.address" type="text" placeholder="Address">
                                <span class="text-danger" v-if="errors['address']">{{errors['address'][0]}}</span>
							</div>
							<div class="">
								<input class="text" v-model="form.password" type="password" placeholder="Password">
							</div>
							<div class="">
								<input class="text" v-model="form.password_confirmation" type="password" placeholder="Password">
							</div>
							<input type="submit" value="Sign Up">
						</form>
					</div>
				</div>
			</div>
			<!-- //contact -->
	</div>
</template>

<script>
export default {
    name: 'UserRegister',
    data() {
        return {
            errors: {},
            form: {}
        }
    },
    methods: {
        userRegister(){
            // console.log(this.form)
            axios.post('/register', this.form)
                .then((result) => {
                    this.$router.push({name: 'UserDashboard'})
					this.$message({
					showClose: true,
					message: 'Registered Successfully, Please login to continue',
					type: 'success'
					});
                })
                .catch((err) => {
                   // console.log(err)
                    this.errors = err.response.data.errors
                })
        }
    }
}
</script>

<style>

</style>