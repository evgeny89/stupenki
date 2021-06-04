<template>
    <div class="wrapper blocks">
        <aside>
            <p class="me-title">личная информация:</p>
            <div class="me-description">
                <p>
                    name: <span class="me-text">{{ name }}</span>
                </p>
                <p>
                    e-mail: <span class="me-text">{{ email }}</span>
                </p>
            </div>
        </aside>
        <div v-if="stupenki">
            <p class="me-title">записи:</p>
            <div class="user-post-list">
                <div v-for="item in stupenki">
                    <h3>{{ item.name }}</h3>
                    <p>страна: {{ item.country }}, город: {{ item.city }}</p>
                    <img :src="item['image_small']" :alt="item.name">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "MePage.vue",
    data() {
        return {
            user: null,
        }
    },
    computed: {
        name: function () {
            return this.user?.name ?? '...';
        },
        email: function () {
            return this.user?.email ?? '...';
        },
        stupenki: function () {
            return this.user && this.user.stupenki ? this.user.stupenki : null;
        }
    },
    methods: {
        getUser: function () {
            axios({
                method: 'GET',
                url: 'api/me',
            }).then(data => {
                this.user = data.data;
            });
        }
    },
    mounted() {
        this.getUser();
    }
}
</script>

<style scoped>

</style>
