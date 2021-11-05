<template>
    <div id="user_master">
        <user-header></user-header>
        <router-view></router-view>
        <user-footer></user-footer>
    </div>
</template>

<script>
import UserHeader from '../user/inc/UserHeader'
import UserFooter from '../user/inc/UserFooter'
export default {
    name: "UserMaster",
    components: {
        UserHeader,
        UserFooter,
    }
}
</script>
