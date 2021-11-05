import Axios from "axios"

export const product = {
    namespaced: true,
    state: {
        products: [],
        product: {},
        sidebarInfo: {},
        maincategoryInfo: {}
    },
    getters: {
        productList(state){
            return state.products
        },
        singleProduct(state){
            return state.product
        },
        productSideBarInfo(state){
            return state.sidebarInfo
        },
        productCategoryInfo(state){
            return state.maincategoryInfo
        }
    },
    actions: {
        productList(context, payload){
            Axios.get('/admin/product/?page='+payload)
                .then(res=>{
                    context.commit('productList', res.data.products)
                })
        },
        getAllProduct(context, payload){
            Axios.get('/product-list/?page='+payload)
                .then(res=>{
                    context.commit('productList', res.data.products)
                })
        },
        deleteProduct(context, payload){
            Axios.delete('/admin/product/'+payload)
                .then(res=>{
                    context.commit('productList', res.data.products)
                })
        },
        editProduct(context, payload){
            Axios.get(`/admin/product/${payload}/edit`)
                .then(res=>{
                    context.commit('singleProduct', res.data.product)
                })
        },
        productSideBarInfo(context){
            Axios.get('product-sidebar')
                .then(res=>{
                    context.commit('productSideBarInfo', res.data)
                })
        },
        productCategoryInfo(context){
            Axios.get('product-category')
                .then(res=>{
                    context.commit('productCategoryInfo', res.data)
                })
        },
        productFilter(context, payload){
            Axios.get(`product-filter/${payload}`)
                .then(res=>{
                    context.commit('productList', res.data.products)
                })
        },
    },
    mutations: {
        productList(state, payload){
            return state.products = payload
        },
        singleProduct(state, payload){
            return state.product = payload
        },
        productSideBarInfo(state, payload){
            return state.sidebarInfo = payload
        },
        productCategoryInfo(state, payload){
            return state.maincategoryInfo = payload
        }
    }
}
