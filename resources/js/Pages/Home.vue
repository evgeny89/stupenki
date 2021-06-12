<template>
    <div class="wrapper blocks">
        <div class="moon"></div>
        <div>
            <h2 class="text">Построим лестницу до Луны!</h2>
            <swiper class="swiper" :options="swiperOption">
                <swiper-slide v-for="item in slides" :key="item.id">
                    <div class="slider-item">
                        <img :src="item['image_high']" :alt="item.name">
                        <router-link :to="{ name: 'post', params: { id: item.id } }" class="home-item-link">{{ item.name }}</router-link>
                    </div>
                </swiper-slide>
                <div class="swiper-pagination" slot="pagination"></div>
            </swiper>
        </div>
        <div class="">
            <img class="stair" src="/images/stair.png" alt="Лестница">
        </div>
        <div class="home-description">
            <p class="text__p text"> Расстояние от Земли до Луны составляет 384.467км. Построим лестницу до Луны из
                1.922.335.000 ступеней.
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
import { Swiper, SwiperSlide } from 'vue-awesome-swiper';

import 'swiper/css/swiper.css';

export default {
    name: "Home",
    components: {
        Swiper,
        SwiperSlide
    },
    data() {
        return {
            count: 0,
            countSlides: 5,
            slides: [],
            swiperOption: {
                loop: true,
                zoom: true,
                pagination: {
                    el: '.swiper-pagination',
                    dynamicBullets: true
                },
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
            }
        }
    },
    methods: {
        getCount: function () {
            axios({
                method: 'GET',
                url: '/api/getCountStupenki',
            })
                .then(response => this.count = response.data)
                .catch(e => {
                    if (Array.isArray(e.response.data)) {
                        this.$emit('handleErrors', e.response.data.errors);
                    } else {
                        this.$emit('showNotify', e.response.data.message, 'Ошибка', 'error');
                    }
                });
        },
        loadSliderData: function () {
            axios({
                method: 'GET',
                url: `/api/stupenki/${this.countSlides}`,
            })
                .then(response => {
                    this.slides = response.data.data;
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
        this.getCount();
        this.loadSliderData();
    }
}
</script>
