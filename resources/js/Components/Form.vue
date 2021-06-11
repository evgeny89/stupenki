<template>
    <form>
        <slot name="body"></slot>
        <button type="button" @click="showText" class="btn">
            <slot>Отправить</slot>
        </button>
    </form>
</template>

<script>
export default {
    name: "Form",
    methods: {
        showText: function () {
            this.$emit('saveComment');
        }
    }
}
</script>

<style scoped>

</style>
