import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate';

Vue.use(Vuex);

const createStore = () => {
  return new Vuex.Store({
    plugins: [createPersistedState({
      storage: window.sessionStorage,
    })],

    state: () => ({
      token: '' as any,
      user: '' as any,
      boardInfo: '' as any,
      kudosInfo: '' as any,
      selectedBoard: '' as any,
      usersList: '' as any,
    }),

    mutations: {
      setUser: (state, newVal: any) => (
        state.user = newVal
      ),

      setToken: (state, newVal: any) => (
        state.token = newVal
      ),

      setBoardInfo: (state, newVal: any) => (
        state.boardInfo = newVal
      ),

      setKudosInfo: (state, newVal: any) => (
        state.kudosInfo = newVal
      ),

      setSelectedBoard: (state, newVal: any) => (
        state.selectedBoard = newVal
      ),

      setUsersList: (state, newVal: any) => (
        state.usersList = newVal
      )
    },

    actions: {},


  })
}

export default createStore;
