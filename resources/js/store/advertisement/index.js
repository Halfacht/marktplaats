import axios from 'axios';
import Advertisement from "../../classes/models/Advertisement";
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
        return state.userAdvertisements;
    },
	advertisement(state) {
		return state.advertisement;
	}
}

const mutations = {
    UPDATE_ADVERTISEMENTS(state, payload) {
		state.advertisements = new AdvertisementCollection(payload.data.map(item => new Advertisement(item)));	
    },
    UPDATE_ADVERTISEMENT(state, payload) {
        state.advertisement = new Advertisement(payload.data)
    },
}

const actions = {
    getAdvertisements({commit}) {
        axios.get('/api/advertisements')
            .then((response) => commit('UPDATE_ADVERTISEMENTS', response.data));
    },
    getAdvertisement({commit}, id) {
		axios.get('/api/advertisements/' + id)
			.then(response => commit('UPDATE_ADVERTISEMENT', response.data))
    },
    addAdvertisement({commit}, data, onSuccess, onFail) {
            axios.post('/api/advertisements', data)
                .then((response) => onSuccess(response))
            	.catch((error) => onFail(error));
    },
}

const advertisementModule = {
    state,
    getters,
    mutations,
    actions,
}

export default advertisementModule;
