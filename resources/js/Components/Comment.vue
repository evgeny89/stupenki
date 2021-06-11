<template>
    <div class="comment">
        <div class="comment-title"><p>{{ comment.user.name }}</p><p>{{ comment['created_at'] }}г.</p></div>
        <p class="comment-text">{{ comment.text }}</p>
    </div>
</template>

<script>
export default {
    name: "Comment",
    props: ['comment']
}
</script>

<style scoped>

</style>
