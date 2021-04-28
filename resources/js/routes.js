import {createRouter, createWebHistory} from "vue-router";
import Home from "./views/Home.vue";
import Login from './views/Login.vue';
import Register from './views/Register.vue';
import CreateAdvertisement from './views/advertisements/Create.vue';
import UserAdvertisements from './views/advertisements/User.vue';
import ShowAdvertisement from './views/advertisements/Show.vue';

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
		path: '/user/advertisements',
		name: 'user.advertisements',
		component: UserAdvertisements,
	},
	{
		path: '/advertisements/create',
		name: 'advertisements.create',
		component: CreateAdvertisement,
	},
	{
		path: "/advertisements/:id",
		name: 'advertisements.show',
		component: ShowAdvertisement,
		props: true,
	},
	{
        path: "/advertisements/:id/edit",
        name: "advertisements.edit",
        component: CreateAdvertisement,
        props: true,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    linkActiveClass: "active",
});

export default router;
