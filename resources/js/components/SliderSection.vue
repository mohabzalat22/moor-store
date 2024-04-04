<template>
    <div class="container">
        <div class="d-flex justify-content-center">
            <button class="btn btn-outline-dark text-capitalize rounded-0" @click="swiperActiveCategory=0">clothes</button>
            <button class="btn btn-outline-dark text-capitalize rounded-0 ms-1" @click="swiperActiveCategory=1">shoes</button>
            <button class="btn btn-outline-dark text-capitalize rounded-0 ms-1" @click="swiperActiveCategory=2">accessories</button>
        </div>
        <div class="swiper">
            <div class="swiper-wrapper mb-5">
                <div v-for="(item, index) in sliderProducts[swiperActiveCategory].items" class="swiper-slide card border-0 mt-5 me-3" style="width: 18rem;">
                    <img :src="`/assets/${item.img}`" loading="lazy" class="card-img-top" alt="">
                    <div class="bg-light d-flex justify-content-between">
                        <div>
                            <p class="small m-0 fw-bold">{{ item.name }}</p>
                            <p class="small m-0">{{ item.category }}</p>
                        </div>
                        <div>
                            <p class="small fw-bold">EGP {{ item.price }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
            <!-- <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div> -->
        </div>
       
    </div>
</template>
<script>
import {Swiper} from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
import 'swiper/swiper-bundle.css';
// import 'swiper/css/navigation';
// import 'swiper/css/pagination';
export default{
    data(){
        return {
            swiperActiveCategory:0,
            sliderProducts:[
                {
                    category:"clothes",
                    items:[
                        {
                            name:'Nice',
                            img:'clothing.webp',
                            category:'shirt',
                            price:550,
                        },
                        {
                            name:'Nice',
                            img:'clothing.webp',
                            category:'shirt',
                            price:550,
                        },
                        {
                            name:'Nice',
                            img:'clothing.webp',
                            category:'shirt',
                            price:550,
                        },
                        {
                            name:'Nice',
                            img:'clothing.webp',
                            category:'shirt',
                            price:550,
                        },
                        {
                            name:'Nice',
                            img:'clothing.webp',
                            category:'shirt',
                            price:550,
                        },
                        {
                            name:'Nice',
                            img:'clothing.webp',
                            category:'shirt',
                            price:550,
                        },
                        {
                            name:'Nice',
                            img:'clothing.webp',
                            category:'shirt',
                            price:550,
                        },
                        {
                            name:'Nice',
                            img:'clothing.webp',
                            category:'shirt',
                            price:550,
                        },
                        {
                            name:'Nice',
                            img:'clothing.webp',
                            category:'shirt',
                            price:550,
                        },
                        {
                            name:'Nice',
                            img:'clothing.webp',
                            category:'shirt',
                            price:550,
                        },
                    ]
                },
                {
                    category:"shoes",
                    items:[
                        {
                            name:'Nice',
                            img:'shoes.webp',
                            category:'shirt',
                            price:550,
                        },
                        {
                            name:'Nice',
                            img:'shoes.webp',
                            category:'shirt',
                            price:550,
                        },
                        {
                            name:'Nice',
                            img:'shoes.webp',
                            category:'shirt',
                            price:550,
                        },
                        {
                            name:'Nice',
                            img:'shoes.webp',
                            category:'shirt',
                            price:550,
                        },
                        {
                            name:'Nice',
                            img:'shoes.webp',
                            category:'shirt',
                            price:550,
                        },
                        {
                            name:'Nice',
                            img:'shoes.webp',
                            category:'shirt',
                            price:550,
                        },
                        {
                            name:'Nice',
                            img:'shoes.webp',
                            category:'shirt',
                            price:550,
                        },
                        {
                            name:'Nice',
                            img:'shoes.webp',
                            category:'shirt',
                            price:550,
                        },
                        {
                            name:'Nice',
                            img:'shoes.webp',
                            category:'shirt',
                            price:550,
                        },
                        {
                            name:'Nice',
                            img:'shoes.webp',
                            category:'shirt',
                            price:550,
                        },
                    ],
                },
                {
                    category:"accessories",
                    items:[
                        {
                            name:'Nice',
                            img:'accessories.jpg',
                            category:'accessories',
                            price:350,
                        },
                        {
                            name:'Nice',
                            img:'accessories.jpg',
                            category:'accessories',
                            price:350,
                        },
                        {
                            name:'Nice',
                            img:'accessories.jpg',
                            category:'accessories',
                            price:350,
                        },
                        {
                            name:'Nice',
                            img:'accessories.jpg',
                            category:'accessories',
                            price:350,
                        },
                        {
                            name:'Nice',
                            img:'accessories.jpg',
                            category:'accessories',
                            price:350,
                        },
                        {
                            name:'Nice',
                            img:'accessories.jpg',
                            category:'accessories',
                            price:350,
                        },
                        {
                            name:'Nice',
                            img:'accessories.jpg',
                            category:'accessories',
                            price:350,
                        },
                        {
                            name:'Nice',
                            img:'accessories.jpg',
                            category:'accessories',
                            price:350,
                        },
                        {
                            name:'Nice',
                            img:'accessories.jpg',
                            category:'accessories',
                            price:350,
                        },
                        {
                            name:'Nice',
                            img:'accessories.jpg',
                            category:'accessories',
                            price:350,
                        },
                    ],
                },
            ]
        }
    },
    mounted() {
        const swiper = new Swiper('.swiper', {
            loop: true,
            slidesPerView: 1,
            slidesPerGroup: 1,
            modules: [Navigation, Pagination],
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints:{
                768 :{
                    slidesPerView: 3,
                    slidesPerGroup: 2,
                },
            }
        });
    },
}    
</script>
<style>
</style>