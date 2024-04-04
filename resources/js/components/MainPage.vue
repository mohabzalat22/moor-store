<template>
    <router-view name="NavBar" :items="NavItems" :activeItem="mainActiveItem" @call-update-main-active-item="UpdateMainActiveItem">
    </router-view>
    <router-view v-slot="{ Component }">
        <component
            :is="Component"
            :items="NavItems" 
            :activeItem="mainActiveItem" 
         />
    </router-view>
</template>
<script>
import NavBar from './NavBar.vue';
import axios from 'axios';
export default{
    components: {
        NavBar,
    },
    data(){
        return {
            mainActiveItem:0,

            NavItems:[],
        }
    },
    created(){
        this.fetchCategories();
    },
    methods:{
        UpdateMainActiveItem(value){
            this.mainActiveItem = value;
            this.$emit('UpdateMainActiveItemInApp', value);
        },
        fetchCategories(){
            let types = ['trending','men','women','kids'];
            let category = ['shoes','clothing','accessories'];
            for(let t of types){
                let item = {name:`${t}`, href:`/${t}`, menu:[]};
                for(let c of category){
                    axios.get('/api/admin/dashboard/site/builder', {params:{type:t, category:c}}).then((res)=>{
                        let data = [];
                        for(let s of res.data){
                            data.push({subcategory:s, href:`/${t}/${c}/${s}`})
                        }
                        let menu = 
                                {
                                    category:`${c}` , href:`/${t}/${c}`, 
                                    data:data
                                };
                                
                        item.menu.push(menu);
                    });
                }
                console.log(item);
                this.NavItems.push(item);
            }
        }
    }
}
</script>
<style>
</style>