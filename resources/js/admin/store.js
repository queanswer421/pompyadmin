import Vue from 'vue'
import Vuex from 'vuex'
import authAxios from './auth-axios.js';
import router from './router';

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    token: null,
    userId: null,
    userType: null
  },
  getters:{
    isAuth: state => state.token !== null
  },
  mutations: {
    auth(state, payload){
      state.token = payload.token;
      state.userId = payload.userId;
      state.userType = payload.userType;
    },
    clearAuth(state){
      state.token = null,
      state.userId = null,
      state.userType = null
    }
  },
  actions: {
    async login({commit}, payload){
      try {
        let response = await authAxios.post('api/login', payload);
        commit('auth', {
          token: response.token,
          userId: response.id,
          userType: 'administrator'
        });
        const now = new Date();
        const endDate = new Date(now.getTime() + 20 * 1000);
        localStorage.setItem('token', response.token);
        localStorage.setItem('userId', response.id);
        localStorage.setItem('expires', endDate);
        // router.push('/admin');
      } catch(e) {
        console.log(e);
      }
    },
    logout({commit}){
      commit('clearAuth');
      localStorage.removeItem('token');
      localStorage.removeItem('userId');
      localStorage.removeItem('expires');
      router.push('/login');
    },
    autologin({commit}) {
      const token = localStorage.getItem('token');
      if(!token) {
        return;
      }
      const userId = localStorage.getItem('userId');
      if(!userId) {
        return;
      }
      const expirationDate = localStorage.getItem('expires');
      const now = new Date();
      if(now >= expirationDate) {
        localStorage.removeItem('token');
        localStorage.removeItem('userId');
        localStorage.removeItem('expires');
        return;
      }

      commit('auth', {
        token,
        userId
      });
    },
  }
})
