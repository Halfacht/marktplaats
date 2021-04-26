import axios from 'axios';
import User from '../../classes/models/User';
import router from '../../routes';

const state = {
    user: new User(),
}

const getters = {
    user: state => {
        return state.user;
    },
    auth: state => {
        return !!state.user.id;
    },
}

const mutations = {
    UPDATE_USER(state, payload) {
        state.user = new User(payload);
    },
}

const actions = {
    login({commit}, data, onSuccess, onFail) {
		axios.post('api/login', data)
			.then((response) => {
				commit('UPDATE_USER', response.data.user);
				router.push('/');
			}).catch((error) => onFail(error));
    },
    register({commit}, data, onSuccess, onFail) {
		axios.post('api/register', data)
			.then((response) => {
				commit('UPDATE_USER', response.data.user);
				onSuccess(response);
			}).catch((error) => onFail(error));
    },
    logout({commit}) {
        axios.post('api/logout')
            .then(() => {
                commit('UPDATE_USER', {});
                router.push('/');
            });
    },
	retrieveUserFromSession({commit}) {
		axios.get('api/check-auth')
			.then((response) => console.log('session', response.data));
	}
}

const userModule = {
    state,
    getters,
    mutations,
    actions,
}

export default userModule;
