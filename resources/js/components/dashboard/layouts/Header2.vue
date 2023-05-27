<template>
    <ul>
        <li>
            <router-link to="/dashboard" class="block btn">Dashboard</router-link>
        </li>
        <li>
            <router-link to="/new-post" class="block btn">New Blog Post</router-link>
        </li>
        <li>
            <router-link to="/all-post" class="block btn">All Post</router-link>
        </li>
        <li>
            <router-link to="/all-post" class="block btn">Users</router-link>
        </li>
        <li>
            <button @click="logOut()" class="block btn">Logout</button>
        </li>
    </ul>    
</template>
    
    <script>
    export default {
        name: 'Header2',
        methods:{
        logOut(){
            localStorage.removeItem('user_id');
            this.$router.push({ name: 'login', query: { redirect: '/login' } });
        }
    }
    }
    
    </script>
    
    <style scoped>
        
    </style>