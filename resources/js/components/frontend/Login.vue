<template>
  <Header />
      <div class="body">
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
   
    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Login into account</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6"  @submit.prevent="login">

      <div>
        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
        <div class="mt-2">
          <input id="email" name="email" v-model="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 pl-5">
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
          <div class="text-sm">
            <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
          </div>
        </div>
        <div class="mt-2">
          <input id="password" name="password" v-model="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 pl-5">
        </div>
      </div>

      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Login</button>
      </div>
    </form>

    <p class="mt-10 text-center text-sm text-gray-500">
      Not a member?
      <a href="#" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Register</a>
    </p>

  </div>
</div>
      </div>
</template>

<script>
import Header from './layouts/Header.vue';
export default {
    name: 'Login',
    components: {
        Header,
    },
    data(){
            return {
              successMsg:'',
              email: '',
              password: '',
            }
        },
    methods: {
      login: function(event) {
          
          axios.post('/api/login', {
              email: this.email,
              password: this.password,
          })
          .then((response)=>{
            console.log(response.data.user_id);
            if(response.status == 200){
              localStorage.setItem('USER_TOKEN', response.data.token)
              localStorage.setItem('user_id', response.data.user_id)
              this.$router.push({ name: 'dashboard', query: { redirect: '/dashboard' } });
            }
          })
          .catch(error =>{
            console.log(error);
          })
        }
    }
}
</script>

<style scoped>
.body {
    background-color: darkseagreen;
    color: white;
}
</style>