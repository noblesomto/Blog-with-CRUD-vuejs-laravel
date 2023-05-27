<template>
    <div class="light_bg">
        <div class="p-20">
            <div class="flex flex-wrap">
                <div class="md:w-1/5 w-full">
                    <Header2 />
                </div>
                <div class="md:w-4/5 w-full"> 
                    <h4 class="uppercase p-4 border-b border-gray-100 font-bold mb-5">New blog Post</h4>
                    
                    <div v-if="successMsg" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative flex justify-center" role="alert">
                        <strong class="font-bold">{{ this.successMsg }}</strong>
                    </div>

                    <form @submit.prevent="blogPost">
                        <div class="mb-3">
                            <label for="email" class="form-label">Post Title</label>
                            <div class="mt-2">
                                <input id="text" name="blog_title" v-model="blog_title" type="text" required class="form-input">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="blog_desc" class="form-label">Task Description</label>
                            <textarea id="blog_desc" v-model="blog_desc" rows="4" class="form-input" placeholder="Blog Details"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Featured Image</label>
                            <div class="mt-2">
                                <input id="text" v-on:change="onFileChange" name="blog_picture" accept="image/*"  type="file" required class="form-input">
                            </div>
                        </div>

                        <div class="flex justify-center mt-5">
                            <button type="submit" class="btn-blue">Create Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import Header2 from './../layouts/Header2.vue';
export default {
    name: 'NewPost',
    components: {
        Header2,
    },
    beforeCreate: function () {
    if (!localStorage.getItem('user_id')) {
        this.$router.push({ name: 'login', query: { redirect: '/login' } });
    }
    },
    data(){
        return {
            successMsg:'',
            blog_title: '',
            blog_desc: '',
            blog_picture: '',
        }
        },
    methods: {
        onFileChange(e) {
        
        this.filename = "Selected File: " + e.target.files[0].name;
        this.blog_picture = e.target.files[0];
        //console.log(this.blog_picture);
        },
      blogPost: function(event) {
        const config = {
            headers: {
                'content-type': 'multipart/form-data',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            }
        }

        let data = new FormData();
        data.append('blog_title', this.blog_title);
        data.append('blog_desc', this.blog_desc);
        data.append('blog_picture', this.blog_picture);
          axios.post('/api/blog-post',data, config)
          .then((response)=>{
            if(response.status == 200){
              this.successMsg = response.data.message;
              console.log(this.successMsg);
              this.blog_title = this.blog_desc ='';
              event.target.reset();
            }
          })
          .catch(error =>{
            this.successMsg = error;
          })
        }
    }
}
</script>


<style scoped>

</style>