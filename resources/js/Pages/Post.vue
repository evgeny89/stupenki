<template>
    <div class="wrapper blocks">
        <div class="post-page-info">
            <button @click="prev" class="prev"><i class="fas fa-angle-double-left"></i></button>
            <h3 class="post-page-title">{{ title }}</h3>
            <p>страна: {{ country }}, город: {{ city }}</p>
            <p>количество ступенек: {{ counter }}</p>
            <p>добавлено: {{ createDate }}г.</p>
            <p>автор: {{ user }}</p>
        </div>
        <div class="post-page-comments">
            <form-component @saveComment="saveComment"  v-if="$root.userToken">
                <template v-slot:body>
                    <textarea name="text" rows="3" v-model="commentText"></textarea>
                </template>
            </form-component>
            <div class="comment-list">
                <comment v-for="comment in comments" :key="comment.id" :comment="comment"></comment>
            </div>
        </div>
        <div class="post-page-photo">
            <img :src="url" :alt="title">
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Comment from "../Components/Comment";
import Form from "../Components/Form";

export default {
    name: "Post",
    components: {Comment, 'form-component': Form},
    data: function () {
        return {
            post: null,
            commentText: '',
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
        comments: function () {
            return this.post ? this.post.comments : []
        }
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
                    if (e.response.status === 404) {
                        this.prev();
                    }else if (Array.isArray(e.response.data)) {
                        this.$emit('handleErrors', e.response.data.errors);
                    } else {
                        this.$emit('showNotify', e.response.data.message, 'Ошибка', 'error');
                    }
                });
        },
        saveComment: function () {
            let comment = new FormData();
            comment.append('text', this.commentText);
            comment.append('post_id', this.post.id);
            axios({
                method: 'POST',
                url: '/api/comment',
                data: comment,
            })
                .then(response => response.data)
                .then(data => {
                    if (data.status === 'Success') {
                        this.$notify(data.message);
                        this.getPost();
                    }
                })
                .catch(e => {
                    if (Array.isArray(e.response.data)) {
                        this.$emit('handleErrors', e.response.data.errors);
                    } else {
                        this.$emit('showNotify', e.response.data.message, 'Ошибка', 'error');
                    }
                });
        },
    },
    mounted() {
        this.getPost();
    }
}
</script>

<style scoped>

</style>
