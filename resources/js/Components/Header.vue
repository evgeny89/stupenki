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
                <button class="btn-login">Вход</button>
            </div>
        </header>
</template>

<script>
export default {
    name: "Header"
}
</script>
