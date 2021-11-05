import Axios from "axios"

export const admin = {
    namespaced: true,
    state: {
        admin: {}
    },
    getters: {
        getAuthAdmin(state){
            return state.admin
        }
    },
    actions: {
        getAdmin(context){
            Axios.get('/admin/user')
                .then(res=>{
                    context.commit('getAdmin', res.data.admin)
                })
                .catch((err)=>{

                })
        }
    },
    mutations: {
        getAdmin(state,payload){
            return state.admin = payload
        }
    }
}