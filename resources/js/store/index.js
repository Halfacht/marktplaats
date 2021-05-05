import {createStore} from 'vuex';
import userModule from './user';
import advertisementModule from './advertisement';
import categoryModule from './category';
import chatModule from './chat';


export default createStore({
    modules: {
        user: userModule,
		advertisement: advertisementModule,
		category: categoryModule,
		chat: chatModule,
    }
})
