<template>
    <div class="offcanvas offcanvas-start bg-light" tabindex="-1" :class="{ 'show' : NavButtonToggled}">
        <div class="offcanvas-header" :class="{'justify-content-end mt-2' : component == 'OffcanvasMenu'}">
            <div v-if="component=='OffcanvasMenuData'" type="button" class="btn offcanvas-icon rounded-circle p-1 border-0" @click="component='OffcanvasMenu'">
                <div class="d-flex">
                    <img src="/public/assets/left-arrow.png" alt="" class="w-100 h-100">
                    <div class="text-secondary ms-3 fw-bold h5 my-0">Back</div>
                </div>
            </div>
            <button type="button" class="btn-close" @click="CallNavButtonToggleMethod"></button>
        </div>
        <div class="offcanvas-body">
            <component :is="component" :items="items" :OffcanvasActiveItem="OffcanvasActiveItem" @call-offcanvas-active-item="UpdateOffcanvasActiveItem"></component>
            <!-- <OffcanvasMenu :items="items" ></OffcanvasMenu> -->
        </div>
    </div>
    <!-- offcanvas-backdrop -->
    <div v-if="NavButtonToggled" class="offcanvas-backdrop fade show"></div>
</template>
<script>
import OffcanvasMenu from './OffcanvasMenu.vue';
import OffcanvasMenuData from './OffcanvasMenuData.vue';
export default{
    components:{
        OffcanvasMenu,
        OffcanvasMenuData
    },
    props:{
        'NavButtonToggled': String,
        'items': Array
    },
    data(){
        return{
            OffcanvasHoverItem:null,
            OffcanvasActiveItem:1,
            component: 'OffcanvasMenu',
        }
    },
    methods:{
        CallNavButtonToggleMethod(){
            this.$emit('UpdateNavButtonToggleMethod')
        },
        UpdateOffcanvasActiveItem(index){
            this.component = 'OffcanvasMenuData';
            this.OffcanvasActiveItem = index;
        }
    }
}
</script>
<style>
.show{
    visibility: visible !important;
}
.offcanvas-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1040;
    width: 100vw;
    height: 100vh;
    background-color: #000;
    opacity: 0.3;
}
.hover-lighter:hover{
    background-color: #f1f1f1 !important;
}
.offcanvas-icon{
    width: 35px;
    height: 35px;
}
.bounce-enter-active,
.bounce-leave-active {
  transition: all 0.5s ease;
}
.bounce-enter-from,
.bounce-leave-to {
  opacity: 0;
  transform: translateX(-30px);
}
</style>