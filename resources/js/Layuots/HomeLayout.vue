<template>
    <div>
        <div class="header">
            <h1>Stupenki.fun</h1>
            <p>
                <router-link :to="{ name: 'home' }">home</router-link>
                <router-link :to="{ name: 'form' }">form</router-link>
            </p>
        </div>

        <div class="wrapper">
            <router-view></router-view>
        </div>
    </div>
</template>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    a {
        text-decoration: none;
        padding: 3px;
    }
    .container {
        padding: 0 calc(50% - 600px);
        background-color: #efefef;
        min-height: 100vh;
    }
    .header {
        display: flex;
        justify-content: space-between;
        padding: 20px 0;
    }
</style>
