<template>
    <Header />
    <div class="p-20">About Page
        <h1>About Page things should appear here</h1>
    </div>
    
</template>

<script>
import Header from './layouts/Header.vue';
export default {
    name: 'Home',
    components: {
        Header,
    },
}
</script>

<style scoped>
div {
    background-color: darkseagreen;
    color: white;
}
</style>