import axios from 'axios';
import store from "../../store";
import router from '../../routes';
import Advertisement from "../../classes/models/Advertisement";
import DEFAULT_DATA from "../../classes/models/Advertisement";
import Paginator from "../../classes/utilities/Paginator";
import AdvertisementCollection from "../../classes/collections/AdvertisementCollection";

const state = {
    advertisements: new AdvertisementCollection(),
	userAdvertisements: new AdvertisementCollection(),
	advertisement: new Advertisement(),
	paginator: new Paginator(),
}

const getters = {
    advertisements(state) {
        return state.advertisements;
    },
    userAdvertisements(state) {
		if (state.userAdvertisements.isEmpty()) {
			store.dispatch('getUserAdvertisements');
		}

		return state.userAdvertisements;
    },
	userAdvertisementById: (state) => (id) =>  {
		let advertisement = state.userAdvertisements.byId(id) ?? state.advertisement;
		
		if (!advertisement && !advertisement.hasId(id)) {
			store.dispatch('getAdvertisement', id);
			advertisement = new Advertisement(DEFAULT_DATA);
		}
		
		return advertisement; 
	},
	advertisement(state) {
		return state.advertisement;
	},
	paginator(state) {
		return state.paginator;
	}
}

const mutations = {
    SET_ADVERTISEMENTS(state, payload) {
		state.advertisements = new AdvertisementCollection(payload.data.map(item => new Advertisement(item)));	
		state.paginator = new Paginator(payload.meta);
    },
	SET_USER_ADVERTISEMENTS(state, payload) {
		state.userAdvertisements = new AdvertisementCollection(payload.data.map(item => new Advertisement(item)));
	},
	SET_ADVERTISEMENT(state, payload) {
		state.advertisement = new Advertisement(payload.data);
	},
	ADD_USER_ADVERTISEMENT(state, payload) {
		state.userAdvertisements.add(new Advertisement(payload.data))
	},
	UPDATE_USER_ADVERTISEMENT(state, payload) {
		state.userAdvertisements.update(payload.data.id, payload.data);
	},
	DELETE_ADVERTISEMENT(state, id) {
		state.userAdvertisements.delete(id);
	},
	RESET_PAGINATOR(state) {
		state.paginator = new Paginator();
	}
}

const actions = {
    getAdvertisements({commit}, options) {
		let queryString = store.getters.paginator.queryString();

		if (options?.search) {
			queryString = queryString.concat(`&search=${options.search}`);
		}

		if (options?.filter) {
			queryString = queryString.concat('&categories=');
			queryString = queryString.concat(options.filter.join());
		}

		if (options?.fromPostcode && options?.maxDistance) {
			queryString = queryString.concat(`&fromPostcode=${options.fromPostcode}`);
			queryString = queryString.concat(`&maxDistance=${options.maxDistance}`);
		}

        axios.get(`/api/advertisements?${queryString}`)
            .then((response) => {
				commit('SET_ADVERTISEMENTS', response.data)
			});
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
	},
	topAdvertisement({commit}, id) {
		axios.post(`/api/advertisements/${id}/top`)
			.then(response => {
				commit('RESET_PAGINATOR');
				store.dispatch('getAdvertisements');
			})
	},
	storeBidding({commit}, form) {
		console.log('inaction form:', form);
		
		axios.post(`/api/advertisements/${form.data.advertisement_id}/biddings`, form.data)
			.then((response) => {
				console.log('response', response);
				
				commit('SET_ADVERTISEMENT', response.data)
				form.onSuccess(response.data.message)
			});
	},
	resetPaginator({commit}) {
		commit('RESET_PAGINATOR');
	}
}

const advertisementModule = {
    state,
    getters,
    mutations,
    actions,
}

export default advertisementModule;
