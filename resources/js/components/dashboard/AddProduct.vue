<template>
       <div class="col-12 col-lg-10">
                <p class="h1 text-dark">Add New Product</p>
                <Transition>
                    <div class="position-fixed bottom-0 end-0 p-3" v-if="showAlertStatus" style="z-index: 1090">
                        <div id="liveToast" class="toast show">
                            <div class="toast-header">
                                Message
                            </div>
                            <div class="toast-body">
                                {{ showAlertMessage }}
                            </div>
                        </div>
                    </div>
                </Transition>
                <div class="p-4" >
                    <div class="row mt-3" v-if="!categoryLoading">
                        <div class="col-12" v-if="categories.length">
                            <label for="" class="text-capitalize my-1">type</label>
                            <select class="form-select" v-model="selectedCategory">
                                <option v-for="(item, index) in categories" :value="item.id">{{ item.type +' - '+ item.category +' - '+ item.subcategory }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="w-100 d-flex justify-content-center" v-else>
                        <div class="spinner-grow text-dark mx-auto">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <label for="" class="text-capitalize my-1">product name</label>
                            <input type="text" class="form-control" v-model="productName">
                        </div>
                        <div class="col-3">
                            <label for="" class="text-capitalize my-1">quantity</label>
                            <input type="number" class="form-control" v-model.number="quantity">
                        </div>
                        <div class="col-3">
                            <label for="" class="text-capitalize my-1">color</label>
                            <input type="text" class="form-control" v-model="color">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <label for="" class="text-capitalize my-1">price</label>
                            <input type="number" class="form-control" v-model.number="price">
                        </div>
                        <div class="col-3" v-if="categories.length">
                            <label for="" class="text-capitalize my-1">currency type</label>
                            <select class="form-select" v-model="currency_type">
                                <option value="egp">egp</option>
                                <option value="dollar">dollar</option>
                                <option value="euro">euro</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="" class="text-capitalize my-1">discount (%)</label>
                            <input type="number" class="form-control" v-model="discount">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <label for="" class="text-capitalize my-1">description</label>
                            <textarea name="" id="" cols="30" rows="10" class="form-control" v-model="description"></textarea>
                        </div>
                        <div class="col-6">
                            <label for="" class="text-capitalize my-1">shipping info</label>
                            <textarea name="" id="" cols="30" rows="10" class="form-control" v-model="shipping_info"></textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <button type="button" class="btn btn-dark text-capitalize rounded-pill" @click="sumbitProduct">
                            save
                        </button>
                    </div>
                </div>
        </div>
</template>
<script>
import axios from 'axios';
export default{
    data(){
        return {
            categories:[],
            categoryLoading: true,
            selectedCategory: '',
            productName:'',
            quantity:'',
            color:'',
            price:'',
            currency_type:'',
            discount:'',
            size:'',
            description:'',
            shipping_info:'',
            showAlertStatus:false,
            showAlertMessage:'',
        }
    },
    created(){
        this.fetchData();
    },
    methods: {
        async fetchData(){
            await axios.get('/api/admin/dashboard/category').then((res)=>{
                this.categories = res.data;
                this.categoryLoading = false;
            });
        },
        toggleShowAlert(value){
            this.showAlertStatus = true;
            this.showAlertMessage = value;
            setTimeout(()=>{
                this.showAlertStatus = false;
                this.showAlertMessage = '';
            }, 2000);
        },
        sumbitProduct(){
            let product = {
                category_id: this.selectedCategory,
                name: this.productName,
                quantity: this.quantity,
                color: this.color,
                description: this.description,
                shipping_info: this.shipping_info,
                currency_type: this.currency_type,
                price: this.price,
                discount: this.discount
            };
            axios.post('/api/admin/dashboard/products', product).then((res)=>{
                if(res.status==200){
                    this.toggleShowAlert('saved');
                }
            });
        },
    },
}
</script>
<style>
.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>