import {createRouter, createWebHistory} from "vue-router";
import Home from "./views/Home.vue";
import Login from './views/Login.vue';
import Register from './views/Register.vue';
import CreateAdvertisement from './views/advertisements/Create.vue'

const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
    },
	{
		path: '/advertisements/create',
		name: 'advertisements.create',
		component: CreateAdvertisement,
	}
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    linkActiveClass: "active",
});

export default router;
