import axios from 'axios';
import MessageCollection from '../../classes/collections/MessageCollection';
import Message from '../../classes/models/Message';
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
		state.conversation = new MessageCollection(payload.data.map(item => new Message(item)));
	},
	ADD_MESSAGE(state, payload) {
		state.conversation.add(new Message(payload.message))
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
