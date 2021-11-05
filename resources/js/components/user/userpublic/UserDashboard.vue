<template>
<div>
  <h3 class="tittle-w3l">User Dashboard
			<span class="heading-style">
				<i></i>
				<i></i>
				<i></i>
			</span>
		</h3>
</div>
</template>

<script>
export default {
    name: 'UserDashboard',
    computed : {
      user() {
        return this.$store.getters['user/getAuthUser']
      }
    },
    methods : {
      getUser() {
        this.$store.dispatch('user/getUser')
      }
    },
    created() {
      this.getUser();
    }
}
</script>

<style>

</style>