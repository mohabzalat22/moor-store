<template>
    <div :showMegaMenu="showMegaMenu" :MegaMenuActiveItem="MegaMenuActiveItem" :items="items" v-if="showMegaMenu" class="mega-menu bg-light p-3 d-none position-absolute " style="z-index:1030" :class="{'d-lg-block' : showMegaMenu}"  @mouseleave="MegaMenuMethod(false, index)">
        <div class="row">
            <ul v-for="(item, index) in items[MegaMenuActiveItem].menu" :key="index" class="list-unstyled col col-md-3 offset-1">
                <router-link :to="item.href"> {{ item.category }}</router-link>
                <li v-for="(menuItem, menuIndex) in item.data" :key="menuIndex" class="my-1 list-unstyled small">
                    <router-link :to="menuItem.href" class="text-decoration-none text-dark small text-capitalize">
                        {{ menuItem.subcategory }}
                    </router-link>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
export default{
    props:{
        showMegaMenu:Boolean,
        items:Array,
        MegaMenuActiveItem:Number,
    },
    data(){
        return {
            
        }
    },
    methods:{
        MegaMenuMethod(value, index){
            this.$emit('CallMegaMenuMethod', value, index)
        }
    }
}
</script>