<template>
    <div class="wrapper blocks">
        <form action="#" id="registration" class="form-registration">
            <div class="flex-between">
               <label for="login" class="label">Name:</label>
               <p class="fail-hint" v-show="loginFail">Имя слишком короткое</p>
            </div>
            <input type="text" id="login" name="name" class="input" :class="{ 'fail-validation': loginFail}" v-model="login">
            <div class="flex-between">
               <label for="email" class="label">E-mail:</label>
               <p class="fail-hint" v-show="!emailFail">Данный email не соответствует шаблону</p>
            </div>
            <input type="text" id="email" name="email" class="input" :class="{ 'fail-validation': !emailFail}" v-model="email">
            <div class="flex-between">
                <label for="pass" class="label">Password:</label>
                <p class="fail-hint" v-show="passFail">Данный пароль слишком короткий</p>
            </div>
            <input type="password" id="pass" name="password" class="input"  :class="{ 'fail-validation': passFail}" v-model="password">
            <div class="flex-between">
                <label for="pass-confirm" class="label">Password confirm:</label>
                <p class="fail-hint" v-show="passConfirmFail">Пароли не совпадают</p>
            </div>
            <input type="password" id="pass-confirm" name="password_confirmation" class="input"  :class="{ 'fail-validation': passConfirmFail}" v-model="passwordConfirm">
            <p class="fail-hint info">Все поля обязательны для заполнения!</p>
            <button class="btn" :disabled="disableBtn" type="button" @click="registration">registration</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "Register",
    data() {
        return {
            login: "",
            password: "",
            passwordConfirm: "",
            email: "",
            checkEmail: new RegExp(/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/),
        }
    },
    computed: {
        loginFail: function () {
            return this.login.length > 0 && this.login.length < 3;
        },
        passFail: function () {
            return this.password.length > 0 && this.password.length < 6;
        },
        passConfirmFail: function () {
            return this.passwordConfirm.length > 0 && this.passwordConfirm !== this.password;
        },
        emailFail: function () {
            return this.email === '' || this.checkEmail.test(this.email);
        },
        disableBtn: function () {
            return this.login.length < 3 || this.password.length < 6 || !this.emailFail || this.passConfirmFail || this.passwordConfirm.length === 0;
        }
    },
    methods: {
        registration: function () {
            axios({
                method: 'POST',
                url: 'api/register',
                data: new FormData(registration),
            })
                .then(response => response.data)
                .then(data => {
                    if (data.status === 'Success') {
                        let token = data.data.token.split('|')[1];
                        localStorage.setItem('token', token);
                        this.$root.replaceToken();
                        this.$emit('showNotify', data.message, 'успех');
                        this.$router.push({ name: 'home' });
                    }
                })
                .catch(e => this.$emit('handleErrors', e.response.data.errors));
        },
    }
}
</script>
