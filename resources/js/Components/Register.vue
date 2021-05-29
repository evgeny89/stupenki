<template>
    <div class="wrapper blocks">
        <form action="#" id="registration">
           <div class="flex-between">
               <label for="login" class="label">Login:</label>
               <p class="fail-hint" v-show="loginFail">Данный логин слишком короткий</p>
           </div>
            <input type="text" id="login" name="login" class="input" :class="{ 'fail-validation': loginFail}" v-model="login">
            <div class="flex-between">
                <label for="pass" class="label">Password:</label>
                <p class="fail-hint" v-show="passFail">Данный пароль слишком короткий</p>
            </div>
            <input type="password" id="pass" name="password" class="input"  :class="{ 'fail-validation': passFail}" v-model="password">
            <button class="btn" :disabled="disableBtn" type="button" @click="registration">save</button>
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
        }
    },
    computed: {
        loginFail: function () {
            return this.login.length > 0 && this.login.length < 3;
        },
        passFail: function () {
            return this.password.length > 0 && this.password.length < 6;
        },
        disableBtn: function () {
            return this.login.length < 3 || this.password.length < 6;
        }
    },
    methods: {
        registration: function () {
            axios({
                method: 'POST',
                url: 'api/user',
                data: new FormData(registration),
                headers: {
                    "Content-type": "application/json; charset=UTF-8"
                }
            })
                .then(response => console.log(response));
        }
    }
}
</script>
