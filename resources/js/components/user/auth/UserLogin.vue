<template>
    <div class="container">
			<!-- tittle heading -->
			<h3 class="tittle-w3l">Sign In
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
						<form action="#" method="post" @submit.prevent="userLogin()">
							<div class="">
								<input class="email" type="email" v-model="form.email" name="email" placeholder="Email">
                                <span class="text-danger" v-if="errors['email']">{{errors['email'][0]}}</span>
							</div>
							<div class="">
								<input type="password" v-model="form.password" name="name" placeholder="Password">
                                <span class="text-danger" v-if="errors['password']">{{errors['password'][0]}}</span>
							</div>
							<input type="submit" value="Sign In">
						</form>
					</div>
				</div>
			</div>
			<!-- //contact -->
	</div>
</template>

<script>
export default {
    name: 'UserLogin',
    data() {
        return {
            form: {},
            errors: {}
        }
    },
    methods: {
        userLogin(){
            axios.post('/login', this.form)
                .then((result) => {
					localStorage.setItem('userLoggedIn', true)
                    this.$router.push({name: 'UserDashboard'})
                })
                .catch((err) => {
                    this.errors = err.response.data.errors
                })
        }
    }
}
</script>

<style>

</style>