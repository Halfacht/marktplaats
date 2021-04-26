import axios from 'axios';

const state = {
    categories: [],
}

const getters = {
    categories: state => {
        return state.categories;
    }
};

const mutations = {
    UPDATE_CATEGORIES(state, payload) {		
        state.categories = payload.data;		
    }
};

const actions = {
    getCategories({commit}) {
        axios.get('/api/categories')
            .then((response) => commit('UPDATE_CATEGORIES', response.data));
    },
};

const categoryModule = {
    state,
    getters,
    mutations,
    actions,
};

export default categoryModule;
