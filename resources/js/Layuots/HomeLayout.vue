<template>
    <div class="app__wrapper">
        <Header ref="header"/>
        <div class="wrapper">
            <router-view @changeToken="changeToken"></router-view>
        </div>
        <Footer />
        <notifications position="top right" />
    </div>
</template>

<script>
import Header from "../Components/Header"
import Footer from "../Components/Footer"

export default {
    name: "HomeLayout",
    components: {
        Header, Footer
    },
    methods: {
        changeToken: function () {
            this.$refs.header.changeToken();
        }
    }
}
</script>



