import axios from 'axios';
import store from "../../store";

const state = {
    conversations: [],
	conversation: {},
}

const getters = {
    conversations: state => {
		if (state.conversations.length <= 0) {
			store.dispatch("getConversations"); 	
		}

        return state.conversations;
    },
	conversation: state => {
		return state.conversation;
	}
};

const mutations = {
    SET_CONVERSATIONS(state, payload) {		
        state.conversations = payload.data;		
    },
	SET_CONVERSATION(state, payload) {
		state.conversation = payload.data;
	},
	ADD_MESSAGE(state, payload) {
		console.log('payload', payload);
		console.log('todo: make add message mutation');
	}
};

const actions = {
    getConversations({commit}) {
        axios.get('/api/messages')
            .then((response) => commit('SET_CONVERSATIONS', response.data));
    },
	getConversation({commit}, id) {
		axios.get(`/api/messages/${id}`)
			.then((response) => commit('SET_CONVERSATION', response.data));
	},
	storeMessage({commit}, form) {
		axios.post('/api/messages', form.data)
			.then((response) => commit('ADD_MESSAGE', response.data));
	}
};

const chatModule = {
    state,
    getters,
    mutations,
    actions,
};

export default chatModule;
