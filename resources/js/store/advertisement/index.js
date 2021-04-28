import axios from 'axios';
import store from "../../store";
import router from '../../routes';
import Advertisement from "../../classes/models/Advertisement";
import DEFAULT_DATA from "../../classes/models/Advertisement";
import AdvertisementCollection from "../../classes/collections/AdvertisementCollection";

const state = {
    advertisements: new AdvertisementCollection(),
	userAdvertisements: new AdvertisementCollection(),
	advertisement: new Advertisement(),
}

const getters = {
    advertisements(state) {
        return state.advertisements;
    },
    userAdvertisements(state) {
        let advertisements = state.userAdvertisements;

		if (advertisements.isEmpty()) {
			store.dispatch('getUserAdvertisements');
		}

		return advertisements;
    },
	advertisementById: (state) => (id) => {
		if (typeof id === 'string') {
            id = parseInt(id)
        }

		if (state.advertisement.id === id) {
			return state.advertisement;
		}

		let advertisement = state.advertisements.byId(id) ?? state.userAdvertisements.byId(id);

		if (!advertisement) {
			store.dispatch('getAdvertisement', id)
		}

		return advertisement ?? new Advertisement(DEFAULT_DATA);
	},
}

const mutations = {
    SET_ADVERTISEMENTS(state, payload) {
		state.advertisements = new AdvertisementCollection(payload.data.map(item => new Advertisement(item)));	
    },
	SET_USER_ADVERTISEMENTS(state, payload) {
		state.userAdvertisements = new AdvertisementCollection(payload.data.map(item => new Advertisement(item)));
	},
	SET_ADVERTISEMENT(state, payload) {
		state.advertisement = new Advertisement(payload.data);
	},
	UPDATE_USER_ADVERTISEMENT(state, payload) {
		state.userAdvertisements.update(payload.data.id, payload.data);
	},
	ADD_USER_ADVERTISEMENT(state, payload) {
		state.userAdvertisements.add(new Advertisement(payload.data))
	},
	DELETE_ADVERTISEMENT(state, id) {
		state.userAdvertisements.delete(id);
	}
}

const actions = {
    getAdvertisements({commit}) {
        axios.get('/api/advertisements')
            .then((response) => commit('SET_ADVERTISEMENTS', response.data));
    },
    getAdvertisement({commit}, id) {
		axios.get('/api/advertisements/' + id)
			.then(response => commit('SET_ADVERTISEMENT', response.data));
    },
	getUserAdvertisements({commit}) {
		axios.get('/api/user-advertisements')
			.then((response) => commit('SET_USER_ADVERTISEMENTS', response.data));
	},
    storeAdvertisement({commit}, form) {
		axios.post('/api/advertisements', form.data)
			.then((response) => {
				commit('ADD_USER_ADVERTISEMENT', response.data);
				router.push('/user/advertisements')
			})
			.catch((error) => form.onFail(error));
    },
	updateAdvertisement({commit}, form) {
		axios.put(`/api/advertisements/${form.data.id}`, form.data)
			.then((response) => {
				commit('UPDATE_USER_ADVERTISEMENT', response.data);
				router.push('/user/advertisements')
			})
			.catch((error) => form.onFail(error));
	},
	deleteAdvertisement({commit}, id) {
		axios.delete(`/api/advertisements/${id}`)
			.then(commit('DELETE_ADVERTISEMENT', id));
	}
}

const advertisementModule = {
    state,
    getters,
    mutations,
    actions,
}

export default advertisementModule;
