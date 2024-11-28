import { createStore } from 'vuex';

export default createStore({
  state: {
    hobis: [],
    siswas: []
  },
  mutations: {
    setHobis(state, hobis) {
      state.hobis = hobis;
    },
    setSiswas(state, siswas) {
      state.siswas = siswas;
    }
  },
  actions: {
    fetchHobis({ commit }) {
      axios.get('http://localhost:8000/api/hobi')
        .then(response => commit('setHobis', response.data));
    },
    fetchSiswas({ commit }) {
      axios.get('http://localhost:8000/api/siswa')
        .then(response => commit('setSiswas', response.data));
    }
  },
  getters: {
    hobis: (state) => state.hobis,
    siswas: (state) => state.siswas
  }
});
