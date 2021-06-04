<template>
    <div class="wrapper blocks">
        <form action="#" id="setStupenki">
            <div class="flex-between">
                <label for="location" class="label">Координаты:</label>
            </div>
            <input type="text" id="location" name="location" class="input" v-model="location">
            <div class="flex-between">
                <label for="country" class="label">Страна:</label>
            </div>
            <input type="text" id="country" name="country" class="input" v-model="country">
            <div class="flex-between">
                <label for="city" class="label">Город:</label>
            </div>
            <input type="text" id="city" name="city" class="input" v-model="city">
            <div class="flex-between">
                <label for="name" class="label">Наименование:</label>
            </div>
            <input type="text" id="name" name="name" class="input" v-model="name">
            <div class="flex-between">
                <label for="image" class="label">Фотография:</label>
            </div>
            <input type="file" id="image" name="image" class="input" @change="setImage($event)">
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
            location: null,
            country: null,
            city: null,
            name: null,
            image: null,
            count: null,
        }
    },
    computed: {
        disableBtn: function () {
            return this.name && +this.count > 0;
        }
    },
    methods: {
        send: function () {
            axios({
                method: 'POST',
                url: 'api/stupenka',
                headers: {
                    'Content-Type': 'multipart/form-data;boundary="boundary"',
                },
                data: new FormData(setStupenki),
            })
                .then(response => response.data)
                .then(data => {
                    if (data.status === 'Success') {
                        this.$notify(data.message);
                        this.$router.push({ name: 'home' });
                    }
                }).catch(e => console.log(e.message));
        },
        setImage: function (e) {
            this.image = e.target.files[0].name;
        }
    }
}
</script>

