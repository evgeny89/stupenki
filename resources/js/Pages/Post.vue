<template>
    <div class="wrapper blocks">
        <div class="post-page-info">
            <button @click="prev" class="prev"><i class="fas fa-angle-double-left"></i></button>
            <h3 class="post-page-title">{{ title}}</h3>
            <p>страна: {{ country }}, город: {{ city }}</p>
            <p>количество ступенек: {{ counter }}</p>
            <p>добавлено: {{ createDate }}г.</p>
            <p>автор: {{ user }}</p>
        </div>
        <div class="post-page-photo">
            <img :src="url" :alt="title">
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Post",
    data: function () {
        return {
            post: null,
        }
    },
    computed: {
        title: function () {
            return this.post ? this.post.name : '...'
        },
        country: function () {
            return this.post ? this.post.country.name : '...'
        },
        city: function () {
            return this.post ? this.post.city.name : '...'
        },
        counter: function () {
            return this.post ? this.post.count : 0
        },
        createDate: function () {
            return this.post ? this.post['created_at'] : '...'
        },
        user: function () {
            return this.post ? this.post.user.name : '...'
        },
        url: function () {
            return this.post ? this.post['image_origin'] : ''
        },
    },
    methods: {
        prev: function () {
            this.$router.go(-1);
        },
        getPost: function () {
            axios({
                method: 'GET',
                url: `/api/stupenka/${this.$route.params.id}`,
            })
                .then(response => {
                    this.post = response.data.data
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
        this.getPost();
    }
}
</script>

<style scoped>

</style>
