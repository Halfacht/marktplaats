import axios from 'axios';
import router from '../../routes';

const state = {
    user: {},
}

const getters = {
    user: state => {
        return state.user;
    },
    auth: state => {
        return state.user.hasOwnProperty('id');
    },
}

const mutations = {
    UPDATE_USER(state, payload) {
        state.user = payload;
    },
}

const actions = {
    login({commit}, data) {
        return new Promise((resolve, reject) => {
            axios.post('api/login', data)
                .then((response) => {
                    commit('UPDATE_USER', response.data.user);
                    resolve(response);
                }).catch((response) => reject(response));
        });
    },
    logout({commit}) {
        axios.post('api/logout')
            .then(() => {
                commit('UPDATE_USER', {});
                router.push('/');
            });
    }
}

const userModule = {
    state,
    getters,
    mutations,
    actions,
}

export default userModule;
