const state = () => ({
    health: 0,
    hunger: 0,
    fatigue: 0,
    name: ''
})
  
  // getters
const getters = {}
  
  // actions
const actions = {
}
  
  // mutations
const mutations = {
    setHealth(state, health) {
        state.health = health;
    },
    setHunger(state, hunger) {
        state.hunger = hunger;
    },
    setFatigue(state, fatigue) {
        state.fatigue = fatigue;
    },
    setName(state, name) {
        state.name = name;
    }
}
  
export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}