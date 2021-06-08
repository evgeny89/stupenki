<template>
    <div class="wrapper blocks">
        <div class="moon"> </div>
        <div><h2 class="text">Построим лестницу до Луны!</h2></div>
        <div class="">
            <img class="stair" src="/images/stair.png" alt="Лестница">
        </div>
        <div>
            <p class="text__p text"> Расстояние от Земли до Луны составляет 384.467км. Построим лестницу до Луны из 1.922.335.000 ступеней.
            </p>
        </div>
        <div class="home-count">
            Всего <span class="home-count-number">{{ count }}</span> ступенек
        </div>
        <div>Рейтинг</div>
    </div>
</template>

<script>

import axios from "axios";

export default {
    name: "Home",
    data() {
        return {
            count: 0,
        }
    },
    methods: {
        getCount: function () {
            axios({
                method: 'GET',
                url: 'api/getCountStupenki',
            })
                .then(response => response.data)
                .then(data => this.count = data);
        }
    },
    mounted() {
        this.getCount();
    }
}
</script>

