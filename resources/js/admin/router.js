import { Alert } from 'bootstrap'
import { toPairs } from 'lodash'
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import AdminDashboard from '../components/admin/AdminDashboard'
import AdminLogin from '../components/admin/auth/AdminLogin'
import CategoryList from '../components/admin/category/CategoryList'
import ProductList from '../components/admin/product/ProductList'
import AddUpdateProduct from '../components/admin/product/AddUpdateProduct'
import OrderList from '../components/admin/order/OrderList'
import OrderDetails from '../components/admin/order/OrderDetails'
import CustomerList from '../components/admin/customer/CustomerList'

const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'active',
    routes: [
        {path:'/admin', component: AdminDashboard, name: 'AdminDashboard'},
        {path:'/admin/login', component: AdminLogin, name: 'AdminLogin'},
        {path:'/admin/categories', component: CategoryList, name: 'CategoryList'},
        {path:'/admin/products', component: ProductList, name: 'ProductList'},
        {path:'/admin/add-product', component: AddUpdateProduct, name: 'AddUpdateProduct'},
        {path:'/admin/edit-product/:productId', component: AddUpdateProduct, name: 'editProduct'},
        {path:'/admin/orders', component: OrderList, name: 'OrderList'},
        {path:'/admin/order-details/:orderId', component: OrderDetails, name: 'OrderDetails'},
        {path:'/admin/customers', component: CustomerList, name: 'CustomerList'},
    ]
})

router.beforeEach((to, from, next) => {
    let isAuthenticated = '';
    let authUser = localStorage.getItem('adminLoggedIn') ? JSON.parse(localStorage.getItem('adminLoggedIn')) : false
    if (authUser) {
        isAuthenticated = authUser.id && authUser.email ? true : false
    }else{
        isAuthenticated = false
    }
    if (to.name !== 'AdminLogin' && !isAuthenticated) next({ name: 'AdminLogin' })
    else if(to.name === 'AdminLogin' && isAuthenticated){
        next({name: 'AdminDashboard'})
    }
    else next()
  })

export default router;
