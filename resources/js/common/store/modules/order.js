import Axios from "axios"

export const order = {
    namespaced: true,
    state: {
        order: {},
        orders: [],
    },
    getters: {
        orderList(state){
            return state.orders
        },
        order(state){
            return state.order
        }
    },
    actions: {
        orderList(context, payload){
            Axios.get('/admin/order/?page='+payload)
                .then(res=>{
                    context.commit('orderList', res.data.orders)
                })
        },
        order(context, payload){
            Axios.get(`/admin/order-detail/${payload}`)
                .then(res=>{
                    context.commit('order', res.data.order)
                })
        },
        // deleteCategory(context, payload){
        //     Axios.delete('/admin/category/'+payload)
        //         .then(res=>{
        //             context.commit('categoryList', res.data.categories)
        //         })
        // },
        // categoryListAll(context){
        //     Axios.get('/admin/all-category')
        //         .then(res=>{
        //             context.commit('categoryList', res.data.categories)
        //         })
        // },
    },
    mutations: {
        orderList(state, payload){
            return state.orders = payload
        },
        order(state, payload){
            return state.order = payload
        }
    }
}