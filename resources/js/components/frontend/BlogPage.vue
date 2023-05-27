<template>
    <Header />
    <div class="bg-light px-20 ">

        <div class="flex justify-center">
            <div class="w-4/5">
                <div class="mt-20 block flex justify-center">
                    <img :src="'/uploads/'+post.blog_picture" class="large-img">
                </div>

                <div class="header">
                    <h4 class="text-xl font-bold mt-12 pb-2 border-b border-gray-200">{{ post.blog_title }}</h4>
                </div>

                <div class="block text-gray-500 text-sm mt-2">
                    <p>{{ post.blog_desc }}</p>
                </div>
            </div>
        </div>
        

        
                
           
    </div>

    <Footer />
</template>

<script>
import Header from './layouts/Header.vue';
import Footer from './layouts/Footer.vue';
import moment from "moment";
export default {
    name: 'Home',
    components: {
        Header,Footer,
    },
    data(){
    return{
        blog_id : this.$route.params.blog_id,
        post:[],


    }
   },
   mounted(){
        
        let response = axios.get(`/api/post-details/${this.blog_id}`)
        .then((response)=>{
        this.post = response.data[0];
        //console.log(response.data[0]);
        })
        .catch(error =>{
            console.log(error);
        })
       
        },

}
</script>

<style scoped>

</style>