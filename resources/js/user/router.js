import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Home from '../components/user/Home'
import Shop from '../components/user/shop/Shop'
import About from '../components/user/shop/About'
import Cart from '../components/user/shop/Cart'
import Checkout from '../components/user/shop/Checkout'
import WishList from '../components/user/shop/WishList'
import Contact from '../components/user/shop/Contact'

// User Component
import UserLogin from '../components/user/auth/UserLogin'
import UserRegister from '../components/user/auth/UserRegister'
import UserDashboard from '../components/user/userpublic/UserDashboard'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {path:'/', component: Home, name: 'Home'},
        {path:'/shop', component: Shop, name: 'Shop'},
        {path:'/about', component: About, name: 'About'},
        {path:'/cart', component: Cart, name: 'Cart'},
        {path:'/contact', component: Contact, name: 'Contact'},
        {
            path:'/checkout', component: Checkout, name: 'Checkout',
            beforeEnter: (to, from, next) => {
                const isAuthenticated = localStorage.getItem('userLoggedIn') ? true : false
                if (to.name !== 'UserLogin' && !isAuthenticated) next({ name: 'UserLogin' })
                else next()
            }
        },
        {
            path:'/wishlist', component: WishList, name: 'WishList',
            beforeEnter: (to, from, next) => {
                const isAuthenticated = localStorage.getItem('userLoggedIn') ? true : false
                if (to.name !== 'UserLogin' && !isAuthenticated) next({ name: 'UserLogin' })
                else next()
            }
        },

        // User Components
        {
            path:'/user-login', component: UserLogin, name: 'UserLogin',
            beforeEnter: (to, from, next) => {
                const isAuthenticated = localStorage.getItem('userLoggedIn') ? true : false
                if (to.name == 'UserLogin' && isAuthenticated) next({ name: 'UserDashboard' })
                else next()
            }
        },
        {path:'/user-register', component: UserRegister, name: 'UserRegister'},
        {
            path:'/user/user-dashboard', component: UserDashboard, name: 'UserDashboard',
            beforeEnter: (to, from, next) => {
                const isAuthenticated = localStorage.getItem('userLoggedIn') ? true : false
                if (to.name !== 'UserLogin' && !isAuthenticated) next({ name: 'UserLogin' })
                else next()
            }
        },
    ]
})

export default router;