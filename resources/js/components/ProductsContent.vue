<template>
    <div class="container-xxl">
        <!-- products-breadcrumb-->
        <div class="row">
            <div class="col-lg-2 ps-5 d-none d-lg-block sidebar vh-100 position-sticky top-0 overflow-y-scroll">
                <!-- bread-crumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb d-flex flex-column">
                        <li class="breadcrumb-item block"><a href="#" class="text-capitalize">home</a></li>
                        <li class="breadcrumb-item text-capitalize active">{{ items[activeItem].name }}</li>
                        <li v-if="this.$route.params.category" class="breadcrumb-item text-capitalize active">{{ this.$route.params.category }}</li>
                        <li v-if="this.$route.params.subcategory" class="breadcrumb-item text-capitalize active">{{ this.$route.params.subcategory }}</li>
                    </ol>
                </nav>
                <!-- menu-items -->
                <ul class="list-unstyled">
                    <li v-for="item in items[activeItem].menu" class="my-1">
                        <router-link class="h5 fw-bold text-dark" :to="item.href">{{ item.category }}</router-link>
                        <router-link v-for="(insideItem, index) in item.data" :to="insideItem.href" class="d-block text-decoration-none text-dark text-capitalize py-1"> {{ insideItem.subcategory }}</router-link>
                    </li>
                </ul>
            </div>
            <!-- products-section -->
            <div class="col-12 col-lg-10">
                <!-- toast message -->
                <div class="toast position-fixed top-25 end-0 align-items-center text-white bg-danger border-0" role="alert" :class="{'show' : showToastMessage}">
                    <div class="d-flex">
                        <div class="toast-body text-capitalize">
                            added successfully to the Wishlist
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" @click="showToastMessage=0"></button>
                    </div>
                </div>
               <!-- main-nav-items -->
                <div class="row mt-2">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div>
                            <div class="nav-product ratio ratio-16x9">
                                <img src="/public/assets/shoes.webp" alt="">
                            </div>
                            <p class="h5 mt-3 fw-bold text-capitalize">shoes</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div>
                            <div class="nav-product ratio ratio-16x9">
                                <img src="/public/assets/clothing.webp" alt="">
                            </div>
                            <p class="h5 mt-3 fw-bold text-capitalize">clothing</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div>
                            <div class="nav-product ratio ratio-16x9">
                                <img src="/public/assets/accessories.jpg" alt="">
                            </div>
                            <p class="h5 mt-3 fw-bold text-capitalize">accessories</p>
                        </div>
                    </div>
                </div>
                <!-- ss -->
                <div class="h3 mt-5 text-capitalize">{{ items[activeItem].name  }}</div>
                 <!-- filter -->
                 <div class="filter position-lg-sticky top-0 d-lg-flex justify-content-between align-items-center mt-2">
                    <div class="row flex-grow-1">
                        <!-- 1 -->
                        <div v-for="(item, index) in filters" class="accordion col-12 col-lg-3 mt-1" id="sortBy" @click="activeCollapseFilter(index)">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button text-capitalize" :class="{'collapsed' : activeCollapseFilterNav!=index}" type="button">
                                        {{ item.name }}
                                    </button>
                                </h2>
                                <div :id="`#collapse${item.name}`" class="accordion-collapse collapse" :class="{'show' : activeCollapseFilterNav==index}">
                                    <div class="accordion-body bg-white border">
                                        <ul class="list-unstyled">
                                            <li v-for="menuItem in item.menu" class="text-capitalize m-0 small w-100 hover-lighter p-2 my-2" @click="addFilter(menuItem)">
                                                {{ menuItem }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3">
                        <button class="small btn btn-danger text-capitalize" @click="selectedFilters=[]">
                            clear
                        </button>
                    </div>
                    <div class="p-3" v-if="products.length>0">
                        <p class="small text-muted m-0">{{products.data.length}} items</p>
                    </div>
                    <!-- items -->
                </div>
                <!-- selected filters -->
                <div class="d-flex flex-wrap mt-3 align-items-center">
                    <div>
                        <p class="text-muted text-capitalize m-0">selected filters({{ selectedFilters.length }})</p>
                    </div>
                    <button v-for="(filter, index) in selectedFilters" class="btn btn-danger ms-3 mt-1" @click="deleteSelectedFilter(index)">
                        <span class="text-capitalize">{{ filter }}</span>
                        <span class="ms-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 50 50" width="25px" height="25px"><path d="M 25 2 C 12.309534 2 2 12.309534 2 25 C 2 37.690466 12.309534 48 25 48 C 37.690466 48 48 37.690466 48 25 C 48 12.309534 37.690466 2 25 2 z M 25 4 C 36.609534 4 46 13.390466 46 25 C 46 36.609534 36.609534 46 25 46 C 13.390466 46 4 36.609534 4 25 C 4 13.390466 13.390466 4 25 4 z M 32.990234 15.986328 A 1.0001 1.0001 0 0 0 32.292969 16.292969 L 25 23.585938 L 17.707031 16.292969 A 1.0001 1.0001 0 0 0 16.990234 15.990234 A 1.0001 1.0001 0 0 0 16.292969 17.707031 L 23.585938 25 L 16.292969 32.292969 A 1.0001 1.0001 0 1 0 17.707031 33.707031 L 25 26.414062 L 32.292969 33.707031 A 1.0001 1.0001 0 1 0 33.707031 32.292969 L 26.414062 25 L 33.707031 17.707031 A 1.0001 1.0001 0 0 0 32.990234 15.986328 z"/></svg>
                        </span>
                    </button>
                </div>
                <!-- products -->
                <div class="row mt-5 user-select-none">
                    <div v-if="products.data">
                        <div v-if="products.data.length == 0" class="alert alert-danger">
                            No Products Found!
                        </div>
                    </div>
                    <div v-else>
                        <div class="alert alert-danger">
                            Error During Fetching Products !
                        </div>
                    </div>
                    <div v-for="(product, index) in products.data" class="col-12 col-md-6 col-lg-4">
                        <!-- card1 -->
                        <div class="card border-0">
                            <div class="card-img-top position-relative">
                                <div class="product-layer position-absolute" :class="{'bg-danger': favoriteList.includes(index)}" @click="addFavorite(index)">
                                    <svg fill="#000000" height="30px" width="30px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                        viewBox="0 0 471.701 471.701" xml:space="preserve">
                                    <g>
                                        <path d="M433.601,67.001c-24.7-24.7-57.4-38.2-92.3-38.2s-67.7,13.6-92.4,38.3l-12.9,12.9l-13.1-13.1
                                            c-24.7-24.7-57.6-38.4-92.5-38.4c-34.8,0-67.6,13.6-92.2,38.2c-24.7,24.7-38.3,57.5-38.2,92.4c0,34.9,13.7,67.6,38.4,92.3
                                            l187.8,187.8c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-3.9l188.2-187.5c24.7-24.7,38.3-57.5,38.3-92.4
                                            C471.801,124.501,458.301,91.701,433.601,67.001z M414.401,232.701l-178.7,178l-178.3-178.3c-19.6-19.6-30.4-45.6-30.4-73.3
                                            s10.7-53.7,30.3-73.2c19.5-19.5,45.5-30.3,73.1-30.3c27.7,0,53.8,10.8,73.4,30.4l22.6,22.6c5.3,5.3,13.8,5.3,19.1,0l22.4-22.4
                                            c19.6-19.6,45.7-30.4,73.3-30.4c27.6,0,53.6,10.8,73.2,30.3c19.6,19.6,30.3,45.6,30.3,73.3
                                            C444.801,187.101,434.001,213.101,414.401,232.701z"/>
                                    </g>
                                    </svg>
                                </div>
                                <div class="swiper">
                                    <!-- Additional required wrapper -->
                                    <div class="swiper-wrapper">
                                        <div v-for="img in product.images" class="swiper-slide">
                                            <img :src="`/upload/${img.source}`" alt="" class="w-100 h-100">
                                            <!-- <div class="swiper-lazy-preloader"></div> -->
                                        </div>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                            <div class="card-body p-1 bg-light">
                                <p class="small text-capitalize m-0 mt-1">{{ product.name }}</p>
                                <div class="d-flex flex-wrap">
                                    <p class="h5 fw-bold text-black text-uppercase mt-1" :class="{'text-decoration-line-through' : product.discount != 0}">{{ product.currency_type }} {{ product.price }}</p>
                                    <p v-if="product.discount != 0" class="h5 fw-bold text-danger text-uppercase mt-1 ms-2">{{ product.currency_type }} {{ product.price - (product.price * product.discount) }}</p>
                                </div>
                                <p v-if="product.discount != 0" class="small text-danger text-capitalize">(save {{ product.discount * 100 }}%)</p>
                                <p class="small text-capitalize text-muted">running sport shoes</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- pagination -->
                <div class="d-flex justify-content-center mt-5">
                    <nav class="cursour-pointer">
                        <ul class="pagination">
                            <li v-for="(link ,index) in products.links" class="page-item" :class="{'active' : link.active}">
                                <a v-if="index==0" class="page-link text-dark" @click="paginate(+page - 1)">Previous</a>
                                <a v-else-if="index==(products.links.length - 1)" @click="paginate(+page + 1)" class="page-link text-dark">Next</a>
                                <a v-else class="page-link text-secondary" @click="paginate(link.label)">{{ link.label }}</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {Swiper} from 'swiper';
import { Pagination } from 'swiper/modules';
import 'swiper/swiper-bundle.css';
import axios from 'axios';
export default{
    props:{
        'items':Array,
        'activeItem':Number,
    },
    data(){
        return {
            products:[],
            favoriteList:[],
            showToastMessage:0,
            selectedFilters:[],
            activeCollapseFilterNav:null,
            page:'1',
            filters:[
                {
                    name:'sortBy',
                    menu:[
                        'relevance',
                        'name a to z',
                        'name z to a',
                        'price low to high',
                        'price high to low'
                    ]
                },
                {
                    name:'price',
                    menu:[
                        'above average',
                        'below average',
                    ]
                },
                {
                    name:'gender',
                    menu:[
                        'men',
                        'women',
                        'kids',
                    ]
                },
                {
                    name:'size',
                    menu:[
                        'xs',
                        'lg',
                        'xl',
                        '2xl',
                    ]
                },

            ],
        }
    },
    methods:{
        addFavorite(index){
            if(this.favoriteList.includes(index)){
                this.favoriteList.splice(this.favoriteList.indexOf(index), 1)
            }
            else{
                this.favoriteList.push(index);
                this.igniteToastMessage();
            }
        },
        igniteToastMessage(){
            this.showToastMessage = 1;
    
            setTimeout(()=>{
                this.showToastMessage = 0;
            }, 1000);
        },
        activeCollapseFilter(index){
            if(this.activeCollapseFilterNav == index){
                this.activeCollapseFilterNav = null;
            }
            else{
                this.activeCollapseFilterNav = index;
            }
        },
        addFilter(item){
            if(!this.selectedFilters.includes(item)){
                this.selectedFilters.push(item);
            }
        },
        deleteSelectedFilter(index){
            this.selectedFilters.splice(index, 1);
        },
        makeSwiper(){
            const swiper = new Swiper('.swiper', {
                modules:[Pagination],
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                },
            });
        },
        paginate(page){
            let max = this.products.links.length - 2;
            if(page <= max && page > 0){
                this.page = page;
                this.fetchData(this.$route.fullPath, this.page);
            }
        },
        async fetchData(endpoint, page){
            this.products = [];
            let prefix = '/api/products';
            console.log(this.$route);
            await axios.get(prefix + endpoint + `?page=${page}`, {
                headers:{'Accept':'application/json'},
                }).then((res)=>{
                if(res.status == 200 && res.headers['content-type'] == 'application/json'){
                    this.products = res.data;
                    setTimeout(()=>{
                        this.makeSwiper(); 
                    }, 1);
                }
            }).catch((e)=>{console.log(e)});
        }
    },
    created() {
      this.$watch(
        () => this.$route.params,
        () => 
        {
            this.fetchData(this.$route.fullPath, this.page);
        },
        { immediate: true }
      )
    },
}
</script>

<style>
.nav-product{
    overflow: hidden;
    border-radius: 40px;
}
.nav-product img{
    object-fit: cover;
    width: 100% !important;
    height: 100% !important;
}
.product-layer{
    z-index: 1000;
    padding: 7px;
    border-radius: 50%;
    bottom: 10px;
    right: 10px;
    transition-duration: .3s;
}
.product-layer img{
    width: 30px;
    height: 30px;
}
.filter{
    z-index: 1010;
}
.toast{
    z-index: 1030;
    transition-duration: .5s;
}
.cursour-pointer{
    cursor: pointer;
}
.page-item.active .page-link{
    background: black !important;
    border:none;
}
.sidebar::-webkit-scrollbar {
  display: none;
}
.overflow-y-scroll{
    overflow-y: scroll;
}
@media (min-width: 576px) { }

@media (min-width: 768px) { }

/* lg */
@media (min-width: 992px) {
    .accordion-collapse{
        position: absolute;
        z-index: 1020;;
    }
    .accordion-header{
        /* max-width: 190px; */
    }
    .accordion-body{
        min-width: 250px;
    }
    .nav-product{
        max-width: 300px;
    }
    .position-lg-sticky{
        position:sticky;
    }
 } 

@media (min-width: 1200px) { }

@media (min-width: 1400px) { }
</style>