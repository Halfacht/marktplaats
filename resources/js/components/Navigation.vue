<template>
    <nav class="navbar navbar-expand-md navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Weblog</a>

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <router-link :to="{ name: 'home' }" class="nav-link">
                        Home
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'newsletter-subscription' }" class="nav-link">
                        Newsletter
                    </router-link>
                </li>

                <template v-if="isWriter">

                    <li class="nav-item">
                        <router-link :to="{ name: 'dashboard' }" class="nav-link">
                            Dashboard
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link :to="{ name: 'blogs.create' }" class="nav-link">
                            New Blog
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{ name: 'categories.create' }" class="nav-link">
                            New Category
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{ name: 'subscription' }" class="nav-link">
                            Subscription
                        </router-link>
                    </li>

                </template>
            </ul>

            <div class="float-end">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <template v-if="auth">
                        <li class="nav-item">
                            <a class="nav-link" href="#" @click="logout">Logout</a>
                        </li>
                    </template>
                    <template v-else>
                        <li class="nav-item">
                            <router-link :to="{ name: 'login' }" class="nav-link"
                            >Login
                            </router-link
                            >
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'register' }" class="nav-link"
                            >Register
                            </router-link
                            >
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    computed: {
        ...mapGetters(["auth", "isWriter"]),
    },
    methods: {
        ...mapActions([
            'logout'
        ]),

    },
};
</script>
