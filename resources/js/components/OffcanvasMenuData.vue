<template>
    <ul class="navbar-nav flex-column flex-grow-1" :items="items" :OffcanvasActiveItem="OffcanvasActiveItem">
        <li v-for="(item, index) in items[OffcanvasActiveItem].menu" class="nav-item" :key="index">
            <router-link v-for="(DataItem, index) in item.data" class="nav-link d-block h5 py-4 px-2 text-dark text-capitalize hover-lighter" :to="DataItem.href">{{ DataItem.subcategory }}</router-link>
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
        OffcanvasActiveItem:Number,
    },
    methods:{

    }
}
</script>
<style>
.hover-lighter:hover{
    background-color: #f1f1f1 !important;
}
</style>