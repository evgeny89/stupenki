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
        <div>
            <p class="me-title">записи:</p>
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
