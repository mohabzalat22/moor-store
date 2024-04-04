<template>
    <div class="container-xxl mt-5 overflow-hidden">
        <div class="row">
            <div class="col-12 col-lg-2 d-lg-flex justify-content-center">
                <div class="mt-5">
                    <router-link to="/admin/dashboard/addcategory" class="py-2 text-capitalize text-dark d-block">add category</router-link>
                    <router-link to="/admin/dashboard/addproduct" class="py-2 text-capitalize text-dark d-block">add product</router-link>
                    <router-link to="/admin/dashboard/products" class="py-2 text-capitalize text-dark d-block" >products</router-link>
                    <router-link to="/admin/dashboard/productdata" class="py-2 text-capitalize text-dark d-block" >product data</router-link>
                </div>
            </div>
            <Transition name="slide-fade">
                <router-view></router-view>
            </Transition>
        </div>
    </div>
</template>
<script>
export default{
    data(){
        return {
        }
    },
    created(){
    },
    methods:{
    }
}
</script>

<style>
    .cursor-pointer{
        cursor : pointer;
    }
    .slide-fade-enter-active {
    transition: all 0.3s ease-out;
    }

    .slide-fade-leave-active {
    transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
    }

    .slide-fade-enter-from,
    .slide-fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
    }
</style>