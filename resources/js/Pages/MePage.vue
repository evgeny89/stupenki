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
                <div v-for="item in stupenki" :key="item.id" class="user-post">
                    <h3 class="post-title">{{ item.name }}</h3>
                    <p>страна: {{ item.country.name }}, город: {{ item.city.name }}</p>
                    <p>количество ступенек: {{ item.count }}</p>
                    <p>добавлено: {{ item['created_at'] }}г.</p>
                    <div class="image-block">
                        <img :src="item['image_small']"
                             :alt="item.name"
                             class="image-small-size"
                        >
                        <img :src="item['image_origin']"
                             :alt="item.name + 'origin'"
                             class="image-full-size"
                        >
                    </div>
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
            showImage: false,
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
            })
                .then(data => {
                    this.user = data.data;
                })
                .catch(e => {
                    if (Array.isArray(e.response.data)) {
                        this.$emit('handleErrors', e.response.data.errors);
                    } else {
                        this.$emit('showNotify', e.response.data.message, 'Ошибка', 'error');
                    }
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
