<template>
    <router-view></router-view>
</template>

<script>
    export default {
        name: "App", 
    }
</script>

<style>
    html {
        user-select: none;
        cursor: default;
    }
    body {
        font-family: "Ubuntu", sans-serif;
    }

    @media (min-width: 0px)
    {
        html {
            font-size: 16px;
        }
    }
    @media (min-width: 576px)
    {

    }
    @media (min-width: 768px)
    {
        html {
            font-size: 14px;
        }
    }
    @media (min-width: 992px)
    {
        
    }
    @media (min-width: 1200px)
    {

    }
</style>
