<template>
    <div class="container">
        <div class="row" :class="{'flex-row-reverse': reverse=='true'}">
            <div class="col-12 col-lg-5 offset-lg-1 d-flex justify-content-center">
                <div class="hero-img-handler">
                    <img :src="`/assets/${img}`" alt=""  class="d-block">
                </div>
            </div>
            <div class="col-12 col-lg-5 center-section">
                <div class="mt-4">
                    <p class="display-4 fw-bold">
                        Rock T-shirt
                    </p>
                    <p class="d-block h6 mt-5">Our best collection.</p>
                    <div class="d-flex py-2">
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    props:['reverse', 'img'],
}
</script>
<style>
    .hero-img-handler{
        max-width: 500px;
        max-height: 800px;
    }
    .hero-img-handler img{
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
@media (min-width: 576px) { }

@media (min-width: 768px) { }

/* lg */
@media (min-width: 992px) {
    .center-section{
        display: flex;
        align-items: center;
        justify-content: center;
    }
 } 

@media (min-width: 1200px) { }

@media (min-width: 1400px) { }
</style>