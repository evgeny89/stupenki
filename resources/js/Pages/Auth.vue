<template>
    <div class="wrapper blocks">
        <form action="#" id="loginData" class="form-registration">
            <div class="flex-between">
                <label for="email" class="label">E-mail:</label>
                <p class="fail-hint" v-show="!emailFail">Данный email не соответствует шаблону</p>
            </div>
            <input type="text" id="email" name="email" class="input" :class="{ 'fail-validation': !emailFail}"
                   v-model="email">
            <div class="flex-between">
                <label for="pass" class="label">Password:</label>
                <p class="fail-hint" v-show="passFail">Данный пароль слишком короткий</p>
            </div>
            <input type="password" id="pass" name="password" class="input" :class="{ 'fail-validation': passFail}"
                   v-model="password">
            <button class="btn" :disabled="disableBtn" type="button" @click="login">login</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "Auth",
    data() {
        return {
            password: "",
            email: "",
            checkEmail: new RegExp(/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/),
        }
    },
    computed: {
        passFail: function () {
            return this.password.length > 0 && this.password.length < 6;
        },
        emailFail: function () {
            return this.email === '' || this.checkEmail.test(this.email);
        },
        disableBtn: function () {
            return !this.checkEmail.test(this.email) || this.password.length < 6;
        }
    },
    methods: {
        login: function () {
            axios({
                method: 'POST',
                url: 'api/login',
                data: new FormData(loginData),
            })
                .then(response => response.data)
                .then(data => {
                    if (data.status === 'Success') {
                        let token = data.data.token.split('|')[1];
                        localStorage.setItem('token', token);
                        this.$root.replaceToken();
                        this.$emit('showNotify', data.message, 'успех');
                        this.$router.push({name: 'home'});
                    }
                })
                .catch(e => {
                    if (Array.isArray(e.response.data)) {
                        this.$emit('handleErrors', e.response.data.errors);
                    } else {
                        this.$emit('showNotify', e.response.data.message, 'Ошибка', 'error');
                    }
                });
        },
    }
}
</script>
