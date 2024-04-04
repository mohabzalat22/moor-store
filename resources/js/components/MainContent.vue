<template>
    <div class="container d-none d-lg-block">
        <div class="row intropage">
            <div class="col-12 col-lg-6">
                <div class="h-100 left-image position-relative d-flex justify-content-center align-items-end">
                    <div class="overlay w-100 h-100"></div>
                    <div class="text-center mb-5">
                        <p class="display-5 text-dark">
                            unique collection of clothes
                        </p>
                        <button class="btn btn-dark px-5 py-2 rounded-pill button-hover-effect">
                            <p class="h4 my-2">Shop Now</p>
                            <img src="/public/assets/right-arrow.png" alt="" width="30px" height="30px">
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="row flex-column h-100">
                    <div class="flex-grow-1 right-top-image p-0 position-relative">
                        <div class="overlay w-100 h-100"></div>
                    </div>
                    <div class="flex-grow-1 right-bottom-image p-0 mt-1 position-relative">
                        <div class="overlay w-100 h-100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <TitleSection title="shop by"></TitleSection>
    <SliderSection></SliderSection>
    <HeroSection reverse="true" img="clothing.webp" class="mt-5">
        <button class="btn btn-dark text-uppercase rounded-0 w-100">shop</button>
    </HeroSection>
    <Footer></Footer>
</template>
<script>
import NavBar from './NavBar.vue';
import HeroSection from './HeroSection.vue';
import TitleSection from './TitleSection.vue';
import SliderSection from './SliderSection.vue';
import Footer from './Footer.vue';
export default{
    components:{
        NavBar,
        HeroSection,
        TitleSection,
        SliderSection,
        Footer
    },
}
</script>
<style>
.intropage{
    height: 800px !important;
    overflow: hidden;
}
.left-image{
    background-image: url(/public/assets/clothing.webp);
    background-size: cover;
}
.right-top-image{
    background-image: url(/public/assets/accessories.jpg);
    background-size: cover;
}
.right-bottom-image{
    background-image: url(/public/assets/shoes.jpg);
    background-position: center;
    background-size: cover;
}
.overlay{
    position: absolute;
    opacity: .2;
    background-image: linear-gradient(rgb(255, 255, 255), rgb(0, 0, 0));
    z-index: 10;
}
.button-hover-effect{
    transition-duration: .5s;
}
.hover-effect:hover img{
    transform: translateX(20px);
}
</style>