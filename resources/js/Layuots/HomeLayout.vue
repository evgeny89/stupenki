<template>
    <div>
        <!-- <div class="header">
            <h1>Stupenki.fun</h1>
            <p>
                <router-link :to="{ name: 'home' }">home</router-link>
                <router-link :to="{ name: 'form' }">form</router-link>
            </p>
        </div> -->
        <Header />

        <div class="wrapper">
            <router-view></router-view>
        </div>
        <Footer />
    </div>
</template>

<script>
import Header from "../Components/Header"
import Footer from "../Components/Footer"

export default {
    name: "HomeLayout",
    components: {
        Header, Footer
    }
}
</script>



