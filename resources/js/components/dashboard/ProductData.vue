<template>
    <div class="col-12 col-lg-10 table-responsive">
        <p class="h1 text-dark">Product Data</p>
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
        <div class="p-4">
            <form  @submit="submit($event)" class="row" action="/api/product/data" method="post" enctype="multipart/form-data">
                <div class="col-6">
                    <label for="" class="text-capitalize my-1">select product</label>
                    <select class="form-select" v-if="products.length" v-model="selectedProduct">
                        <option v-for="(item, index) in products" :value="item.id">{{ item.name }}</option>
                    </select>
                    <div class="w-100 d-flex justify-content-center" v-else>
                        <div class="spinner-grow text-dark mx-auto">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <label for="" class="text-capitalize my-1">select image</label>
                    <input type="file" class="form-control" @change="onFileChange">
                </div>
                <div class="col-12 mt-2">
                    <label for="" class="text-capitalize my-1">select size</label>
                    <input type="text" class="form-control" v-model="size">
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-dark rounded-pill w-100">save</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return {
            products:[],
            productLoading:true,
            selectedProduct:null,
            size:'',
            image:'',
            showAlertStatus:false,
            showAlertMessage:''

        }
    },
    created(){
        this.fetchData();
    },
    methods:{
        async fetchData(){
            await axios.get('/api/admin/dashboard/products').then((res)=>{
                this.products = res.data;
                this.productLoading = false;
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
        onFileChange(e){
            console.log(e.target.files[0]);
            this.image = e.target.files[0];
        },
        submit(event)
        {
            event.preventDefault();
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            };

            let fromData = new FormData();
            fromData.append('image', this.image);
            fromData.append('product_id', this.selectedProduct);
            fromData.append('size', this.size);

            axios.post('/api/admin/dashboard/product/data', fromData, config).then((res)=>{
                if(res.status==200){
                    this.toggleShowAlert('done');
                }
            });
        },
    }
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