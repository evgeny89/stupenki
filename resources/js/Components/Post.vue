<template>
    <router-link :to="{ name: 'post', params: { id: post.id } }">
            <h3 class="post-title">{{ post.name }}</h3>
            <p>страна: {{ post.country.name }}, город: {{ post.city.name }}</p>
            <p>количество ступенек: {{ post.count }}</p>
            <p>добавлено: {{ post['created_at'] }}г.</p>
            <div class="image-block">
                <img :src="post['image_small']"
                     :alt="post.name"
                     class="image-small-size"
                >
                <img :src="post['image_origin']"
                     :alt="post.name + 'origin'"
                     class="image-full-size"
                >
            </div>
            <p class="post-comments_link">Комментариев: {{ post['comments_count'] }}</p>
    </router-link>
</template>

<script>
export default {
    name: "Post",
    props: ['post'],
}
</script>

<style scoped>

</style>
