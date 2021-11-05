<template>
    <div id="admin_master">
        <div class="wrapper">

            <template v-if="$route.name !== 'AdminLogin'">
            <admin-header></admin-header>
            <admin-sidebar></admin-sidebar>
            </template>
                <router-view></router-view>


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
            <admin-footer v-if="$route.name !== 'AdminLogin'"></admin-footer>

        </div>
    </div>
</template>

<script>
import AdminFooter from './inc/AdminFooter'
import AdminHeader from './inc/AdminHeader'
import AdminSidebar from './inc/AdminSidebar'
export default {
    name: 'AdminMaster',
    components:{
        AdminFooter,
        AdminHeader,
        AdminSidebar
    }
}
</script>
