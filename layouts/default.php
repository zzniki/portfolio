<head>
    <script src="/assets/dep/svg-loader.min.js"></script>
    <script src="/assets/dep/gsap.min.js"></script>
    <script src="/assets/dep/ScrollTrigger.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/main.css">
</head>

<template>

    <Loader/>

    <StaticBg/>
    <Header/>
    
    <slot/>
</template>

<style>

@import url("/main.css");

</style>