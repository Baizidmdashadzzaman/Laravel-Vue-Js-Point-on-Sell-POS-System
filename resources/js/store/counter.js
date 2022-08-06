export default {
    namespaced: true,
    state:{
        count:0
    },
    getters:{
        count(state){
            return state.count
        }
    },
    mutations:{
        SET_COUNT (state, value) {
            state.count ++
        },
        SET_COUNT100 (state, value) {
            state.count =state.count+100
        },
        SET_COUNT_D (state, value) {
            state.count --
        },
        SET_COUNT_D_100 (state, value) {
            state.count =state.count-100
        },
    },
    actions:{
        increment({commit}){
            commit('SET_COUNT',0)
        },
        increment100({commit}){
            commit('SET_COUNT100',1000)
        },
        decrement({commit}){
            commit('SET_COUNT_D',0)
        },
        decrement100({commit}){
            commit('SET_COUNT_D_100',1000)
        },
    }
}