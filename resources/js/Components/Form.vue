<template>
    <div class="wrapper blocks">
        <form action="#" id="setStupenki">
            <div class="flex-between">
                <label for="address" class="label">Адресс:</label>
            </div>
            <input type="text" id="address" name="location" class="input" v-model="address">
            <div class="flex-between">
                <label for="count" class="label">Количество ступенек:</label>
            </div>
            <input type="number" id="count" name="count" class="input" v-model="count">
            <button class="btn" :disabled="!disableBtn" type="button" @click="send">Добавить</button>
        </form>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Form",
    data() {
        return {
            address: null,
            count: 0,
        }
    },
    computed: {
        disableBtn: function () {
            return this.address && +this.count > 0;
        }
    },
    methods: {
        send: function () {
            axios({
                method: 'POST',
                url: 'api/stupenka',
                data: new FormData(setStupenki),
            })
                .then(response => response.data)
                .then(data => {
                    if (data.status === 'Success') {
                        this.$notify(data.message);
                        this.$router.push({ name: 'home' });
                    }
                }).catch(e => console.log(e.message));
        }
    }
}
</script>

