<template>
    <div class="container-xxl">
        <div class="position-relative">
            <nav class="navbar navbar-expand-lg sticky-top navbar-light p-0">
                <div class="container-xxl py-3">
                    <a class="navbar-brand rounded-circle overflow-hidden p-0" href="#">
                        <img src="/public/assets/3BS.png" alt="" width="90px" height="90px">
                    </a>
                    <!-- navbar button -->
                    <NavBarButton :NavButtonToggled="NavButtonToggled" @update-nav-button-toggle-method="NavButtonToggleMethod"></NavBarButton>
                    <!-- offcanvas -->
                    <Offcanvas :NavButtonToggled="NavButtonToggled" @update-nav-button-toggle-method="NavButtonToggleMethod" :items="items" ></Offcanvas>
                    <!-- navbar-nav -->
                    <NavBarNav :showMegaMenu="showMegaMenu" :items="items" :activeItem="activeItem"  @call-mega-menu-method="UpdateMegaMenuMethod" @call-change-active-item="UpdateActiveItem"></NavBarNav>
                </div>
            </nav>
            <transition name="fade">
                <MegaMenu :showMegaMenu="showMegaMenu" :items="items" :activeItem="activeItem" :MegaMenuActiveItem="MegaMenuActiveItem" @call-mega-menu-method="UpdateMegaMenuMethod"></MegaMenu>
            </transition>
            <transition name="fade">
                <div v-if="showMegaMenu" class="position-absolute drop-back-layer"></div>
            </transition>
        </div>
    </div>
</template>

<script>
import NavBarButton from './NavBarButton.vue';
import Offcanvas from './Offcanvas.vue';
import MegaMenu from './MegaMenu.vue';
import NavBarNav from './NavBarNav.vue';

export default{
    props:{
        items:Array
    },
    components:{
        NavBarButton,
        Offcanvas,
        MegaMenu,
        NavBarNav
    },
    data(){
        return {
            NavButtonToggled:false,
            showMegaMenu:false,
            activeItem:0,
            MegaMenuActiveItem:0,
        }
    },
    methods:{
        NavButtonToggleMethod(){
            this.NavButtonToggled = !this.NavButtonToggled;
        },
        UpdateMegaMenuMethod(value, index){
            this.MegaMenuActiveItem = index;
            this.showMegaMenu = value;
        },
        UpdateActiveItem(value){
            this.activeItem = value;
            // update parent =>(mainPage)
            this.$emit('CallUpdateMainActiveItem',value);
        }
    }

}
</script>
<style>
.mega-menu{
    top:100px;
    transition-duration: 3s;
    width: 100%;
}
.mega-menu a:hover{
    /* font-weight: bold; */
    text-decoration: underline !important;
}
.drop-back-layer{
    background-color: black;
    opacity: 0.3;
    width: 100%;
    height: calc(100vh + 300%);
    z-index: 1020;
}
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.2s ease-out;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>