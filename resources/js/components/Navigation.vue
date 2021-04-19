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

                <template v-if="auth">

                    <li class="nav-item">
                        Hier komt wat als je ingelogd bent
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
        ...mapGetters(["auth"]),
    },
    methods: {
        ...mapActions([
            'logout'
        ]),

    },
};
</script>
