<template>
    <div class="collapse navbar-collapse" :items="items" :activeItem="activeItem" :MegaMenuActiveItem="MegaMenuActiveItem" :showMegaMenu="showMegaMenu">
        <ul class="navbar-nav">
            <li v-for="(item, index) in items" class="nav-item" :key="index" @click="ChangeActiveItem(index)" @mouseover="MegaMenuMethod(true, index)">
                <router-link v-if="index==0" class="nav-link text-capitalize" aria-current="page" to="/" :class="{'active': activeItem == index}">{{ item.name }}</router-link>
                <router-link v-else class="nav-link text-capitalize" aria-current="page" :to="item.href" :class="{'active': activeItem == index}">{{ item.name }}</router-link>
            </li>
        </ul>
        <div class="ms-auto d-flex align-items-center">
            <div>
                <input type="text" class="form-control" placeholder="Search">
            </div>
            <div class="nav-icon ms-2">
                <img src="/public/assets/heart.png" alt="" class="w-100 h-100">
            </div>
            <div class="nav-icon ms-2">
                <img src="/public/assets/cart.png" alt="" class="w-100 h-100">
            </div>
        </div>
    </div>
</template>
<script>
export default{
    props:{
        showMegaMenu:Boolean,
        items:Array,
        activeItem:Number,
        MegaMenuActiveItem:Number
    },
    data(){
        return {
            
        }
    },
    methods:{
        MegaMenuMethod(value, index){
            this.$emit('CallMegaMenuMethod', value, index)
        },
        ChangeActiveItem(value){
            this.$emit('CallChangeActiveItem', value);
        }
    }
    
}
</script>
<style>
.nav-icon{
    width: 25px;
    height: 25px;
}
</style>