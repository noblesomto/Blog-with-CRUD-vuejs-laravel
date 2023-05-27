<template>
    <div class="light-bg">
        <div class="p-20">
            <div class="flex flex-wrap">
                <div class="md:w-1/5 w-full">
                    <Header2 />
                </div>
                <div class="md:w-4/5 w-full"> 
                    <h4 class="uppercase p-4 border-b border-gray-100 font-bold">Dashboard</h4>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid recusandae repellendus ullam porro sed dicta dolorem, deserunt velit similique quas ex nemo molestias necessitatibus iste reprehenderit, distinctio temporibus quisquam nihil! Dignissimos id, error explicabo porro dolor optio nihil aut sint ipsa numquam quibusdam nostrum earum rem quod laborum. Repellendus, quisquam.
                    </p>
                
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint cum error facilis iure magni, architecto sit inventore. Ea commodi omnis, ut eos amet quisquam iste distinctio minus ducimus sunt maiores hic quas vero ex quia quam, maxime ipsum eius architecto eum vitae esse aspernatur rem suscipit. Aspernatur rem fugiat doloremque.
                    </p>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import Header2 from './layouts/Header2.vue';
export default {
    name: 'Dashboard',
    components: {
        Header2,
    },
    data(){
        return{
            
        }
    },
    beforeCreate: function () {
    if (!localStorage.getItem('user_id')) {
        this.$router.push({ name: 'login', query: { redirect: '/login' } });
    }
    }
}
</script>

<style scoped>

</style>