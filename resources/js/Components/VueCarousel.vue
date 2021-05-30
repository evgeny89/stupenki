<template>
    <carousel :navigationEnabled=true :perPage=1>
        <slide>
            <div class="slide__img">
                <img src="http://via.placeholder.com/500x365" alt="">
            </div>
            <div class="slide__info">
                <h4 class="slide__title">Город</h4>
                <p class="slide__text">Достопримечательность</p>
                <p class="slide__number">20 ступенек</p>
            </div>
        </slide>
        <slide>
            <div class="slide__img">
                <img src="http://via.placeholder.com/215x230" alt="">
            </div>
            <div class="slide__info">
                <h4 class="slide__title">Город</h4>
                <p class="slide__text">Достопримечательность kjuhbfgv oaedrgbv loiajdgbv ilajbrv lijdb ;idsbj oidashjbv kluashbv</p>
                <p class="slide__number">20 ступенек</p>
            </div>
        </slide>
        <slide>
            <div class="slide__img">
                <img src="http://via.placeholder.com/215x230" alt="">
            </div>
            <div class="slide__info">
                <h4 class="slide__title">Город</h4>
                <p class="slide__text">Достопримечательность</p>
                <p class="slide__number">20 ступенек</p>
            </div>
        </slide>
        <slide>
            <div class="slide__img">
                <img src="http://via.placeholder.com/215x230" alt="">
            </div>
            <div class="slide__info">
                <h4 class="slide__title">Город</h4>
                <p class="slide__text">Достопримечательность</p>
                <p class="slide__number">20 ступенек</p>
            </div>
        </slide>
    </carousel>
</template>
<script>
import { Carousel, Slide } from 'vue-carousel';

export default {
    name: "VueCarousel",

    components: {
        Carousel, Slide
    }
}
</script>
