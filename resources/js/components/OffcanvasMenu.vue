<template>
    <ul class="navbar-nav flex-column flex-grow-1" :items="items" :OffcanvasHoverItem="OffcanvasHoverItem" >
        <li v-for="(item, index) in items" class="nav-item py-4 px-2 m-0" :class="{'hover-lighter' : OffcanvasHoverItem == index }" :key="index" @mouseover="OffcanvasHoverItem=index" @click="CallOffcanvasActiveItemMethod(index)">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a class="nav-link h5 m-0 text-dark text-capitalize" href="#">{{ item.name }}</a>
                </div>
                <transition name="bounce">
                    <div v-if="OffcanvasHoverItem==index" class="offcanvas-icon rounded-circle p-1 bg-dark">
                        <img src="/public/assets/right-arrow.png" alt="" class="w-100 h-100">
                    </div>
                </transition>
            </div>
        </li>
    </ul>
</template>

<script>
export default{
    data(){
        return {
        }
    },
    props:{
        items:Array,
        OffcanvasHoverItem:Number,
    },
    methods:{
        CallOffcanvasActiveItemMethod(index){
            this.$emit('CallOffcanvasActiveItem', index);
        }
    }
}
</script>