<template>
    <div>
        <Header/>
        <div class="wrapper">
            <router-view @showNotify="showNotify" @handleErrors="handleErrors"></router-view>
        </div>
        <Footer />
        <notifications position="top right" />
    </div>
</template>

<script>
import Header from "../Pages/Header"
import Footer from "../Pages/Footer"

export default {
    name: "HomeLayout",
    components: {
        Header, Footer
    },
    methods: {
        showNotify: function (message, title, type = 'success') {
            this.$notify({
                title: title,
                text: message,
                type: type,
            });
            //type: success, warn, error
        },
        handleErrors: function (errors) {
            for (let field in errors) {
                errors[field].forEach(text => this.showNotify(text, `Ошибка ${field}`, 'error'))
            }
        }
    }
}
</script>



