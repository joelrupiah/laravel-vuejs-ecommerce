import Axios from "axios"

export const cart = {
    namespaced: true,
    state: {
        products: [],
    },
    getters: {
        productList(state){
            return state.products
        }
    },
    actions: {
        productList(context){
            Axios.get('/cart/cart-product-list')
                .then(res=>{
                    context.commit('productList', res.data)
                })
        },
        
    },
    mutations: {
        productList(state, payload){
            return state.products = payload
        }
    }
}