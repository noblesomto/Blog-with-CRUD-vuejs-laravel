<template>
    <div class="light-bg">
        <div class="p-20">
            <div class="flex flex-wrap">
                <div class="md:w-1/5 w-full">
                    <Header2 />
                </div>
                <div class="md:w-4/5 w-full"> 
                    <h4 class="uppercase p-4 border-b border-gray-100 font-bold">All Post</h4>
                    
                    <table class="table-auto">
                        <thead>
                            <tr>
                            <th class="px-4 py-2">Title</th>
                            <th class="px-4 py-2">Picture</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="post in posts" :key="post.id">
                            <td class="border px-4 py-2">{{ post.blog_title }}</td>
                            <td class="border px-4 py-2"><img :src="'/uploads/'+post.blog_picture" class="small-img"></td>
                            <td class="border px-4 py-2">{{ post.blog_status }}</td>
                            <td class="border px-4 py-2">
                                <router-link :to="`/edit-post/${post.blog_id}`" class="btn-blue mr-2">Edit</router-link>

                                <button @click="deletePost(post.blog_id)" class="dark-btn">Delete</button>
                            </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import Header2 from './../layouts/Header2.vue';
export default {
    name: 'AllPost',
    components: {
        Header2,
    },
    data(){
    return{
      posts:[]
    }
   },
   beforeCreate: function () {
    if (!localStorage.getItem('user_id')) {
        this.$router.push({ name: 'login', query: { redirect: '/login' } });
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
    deletePost(id){
        if(confirm("Are you sure to delete this Post ?")){
            axios.get(`/api/delete-post/${id}`).then(response=>{
                this.getPosts()
            }).catch(error=>{
                console.log(error)
            })
        }
    }

    },
    mounted(){
      this.getPosts();
    }
}
</script>

<style scoped>

</style>