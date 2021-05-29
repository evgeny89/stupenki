<template>
    <header class="header">
            <div class="wrapper menu">
                <div></div>
                <nav class="nav">
                    <router-link
                        :to="{ name: 'home' }"
                        class="menu_nav"
                        exact
                    >Главная</router-link>

                    <router-link
                        :to="{ name: 'about' }"
                        class="menu_nav"
                    >О проекте</router-link>

                    <router-link
                        :to="{ name: 'search' }"
                        class="menu_nav"
                    >Поиск</router-link>

                    <router-link
                        :to="{ name: 'register' }"
                        class="menu_nav"
                    >Регистрация</router-link>
                </nav>
                <button
                    class="btn-login"
                    @click="toggleIsOpen"
                >Вход</button>
            </div>
            <AuthModal v-if="isOpen"  />
        </header>
</template>

<script>
import AuthModal from './AuthModal.vue'

export default {
    name: "Header",
    data () {
        return {
            isOpen: false,
        }
    },

    computed: {
        path: function () {
            return this.$route.path
        }
    },

    methods: {
        toggleIsOpen: function () {
            if(this.path === "/register") {
                return
            }
            return this.isOpen = !this.isOpen
        }
    },

    components: {
        AuthModal
    }
}
</script>
