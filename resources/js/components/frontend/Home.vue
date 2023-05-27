<template>
    <Header />
    <div class="bg-light px-20 ">

        <div class="">
            <Slider />
        </div>

        <div class="header">
            <h4 class="text-xl font-bold mt-12 pb-2 border-b border-gray-200">Latest Blog Post</h4>
        </div>
      
            <div class="mt-8 grid lg:grid-cols-3 gap-10">
                <!-- cards go here-->
                <div class="card hover:shadow-lg" v-for="post in posts" :key="post.id">
                    <img :src="'/uploads/'+post.blog_picture" alt="" class="w-full h-32 sm:h-48 object-cover">
                    <div class="m-4">
                        <router-link :to="`/post-details/${post.blog_id}`"><span class="font-bold">{{ post.blog_title }}</span></router-link>

                        <div class="block text-gray-500 text-sm mt-2">
                            <p v-snip="{ lines: 2 }"> {{ post.blog_desc }} </p>
                        </div>
                    </div>
                    <div class="badge">
                        <span>{{ dateTime(post.created_at) }}</span>
                    </div>
                </div>
            </div>
           
    </div>

    <Footer />
</template>

<script>
import Header from './layouts/Header.vue';
import Footer from './layouts/Footer.vue';
import Slider from './layouts/Slider.vue';
import moment from "moment";
export default {
    name: 'Home',
    components: {
        Header,Footer,Slider,
    },
    data(){
    return{
      posts:[],


    }
   },
   methods: {
    getPosts(){
        axios.get('/api/all-post')
        .then((response)=>{
            this.posts = response.data;
        })
        .catch(error =>{
            console.log(error);
        })
    },
    dateTime(value) {
      return moment(value).format("Do MMM");
    }

    },
    mounted(){
      this.getPosts();
    }
}
</script>

<style scoped>

</style>