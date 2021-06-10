<template>
    <header class="header">
        <div class="wrapper menu">
            <div></div>
            <nav class="nav">
                <router-link v-for="route in routeList" :key="route.url"
                    :to="{ name: route.url }"
                    class="menu_nav"
                    exact
                >{{ route.name }}</router-link>
            </nav>
            <router-link class="btn-login" v-if="!$root.userToken" :to="{name: 'auth'}">Вход</router-link>
            <button class="btn-login" v-else @click="logout">Выход</button>
        </div>
    </header>
</template>

<script>
import axios from "axios";

export default {
    name: "Header",
    data() {
        return {
            routes: [
                {
                    url: 'home',
                    name: 'Главная',
                    auth: null,
                },
                {
                    url: 'about',
                    name: 'О проекте',
                    auth: null,
                },
                {
                    url: 'search',
                    name: 'Поиск',
                    auth: null,
                },
                {
                    url: 'register',
                    name: 'Регистрация',
                    auth: false,
                },
                {
                    url: 'form',
                    name: 'Новая запись',
                    auth: true,
                },
                {
                    url: 'me',
                    name: 'Моя страничка',
                    auth: true,
                },
            ]
        }
    },
    computed: {
        routeList: function () {
            return this.$root.userToken ? this.routes.filter(i => i.auth !== false) : this.routes.filter(i => i.auth !== true);
        }
    },
    methods: {
        logout: function () {
            axios({
                method: 'POST',
                url: 'api/logout',
            }).then(data => {
                localStorage.removeItem('token');
                this.$root.replaceToken();
                this.$notify({
                    title: 'Выход',
                    text: data.data.message,
                    type: 'success',
                });
                if (this.$route.name !== 'home') {
                    this.$router.push({ name: 'home' });
                }
            });
        },
    },
}
</script>
