<template>
        <div class="col-12 col-lg-10 table-responsive">
            <p class="h1 text-dark">Products</p>
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
            <table class="table table-hover" v-if="!productLoading">
                <thead>
                    <tr class="row">
                        <th scope="col" class="col-1"><p class="text-uppercase m-0">id</p></th>
                        <th scope="col" class="col-3"><p class="text-capitalize m-0">name</p></th>
                        <th scope="col" class="col-2"><p class="text-capitalize m-0">qunatity</p></th>
                        <th scope="col" class="col-2"><p class="text-capitalize m-0">price x 1</p></th>
                        <th scope="col" class="col-2"><p class="text-capitalize m-0">show and edit</p></th>
                        <th scope="col" class="col-2"><p class="text-capitalize m-0">delete</p></th>
                    </tr>
                </thead>
                <tbody class="table-striped">
                    <tr v-for="(item, index) in products" class="row">
                        <th scope="row" class="col-1">{{ index + 1 }}</th>
                        <td class="col-3">{{ item.name }}</td>
                        <td class="col-2">{{ item.quantity }}</td>
                        <td class="col-2">{{ item.price + ' ' + item.currency_type }}</td>
                        <td class="col-2"> <button class="btn btn-success" @click="showEditProduct(index)">show and edit</button></td>
                        <td class="col-2"> <button class="btn btn-danger" @click="deleteProduct(item.id)">delete</button></td>

                    </tr>
                </tbody>
            </table>
            <!-- spinner -->
            <div v-else class="d-flex justify-content-center">
                <div class="spinner-grow text-dark" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <!-- modal -->
            <Transition>
                <div class="modal d-block" v-if="showModal">
                    <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Show and Edit</h5>
                            <button type="button" class="btn-close" @click="showModal=false"></button>
                        </div>
                        <div class="modal-body">
                            <label for="" class="mt-2">name</label>
                            <input type="text" class="form-control mt-1" v-model="modalData.name" :disabled="!allowEdit">
    
                            <label for="" class="mt-2">quantity</label>
                            <input type="text" class="form-control mt-1" v-model="modalData.quantity" :disabled="!allowEdit">
    
                            <label for="" class="mt-2">color</label>
                            <input type="text" class="form-control mt-1" v-model="modalData.color" :disabled="!allowEdit">
    
                            <label for="" class="mt-2">description</label>
                            <input type="text" class="form-control mt-1" v-model="modalData.description" :disabled="!allowEdit">
    
                            <label for="" class="mt-2">shipping_info</label>
                            <input type="text" class="form-control mt-1" v-model="modalData.shipping_info" :disabled="!allowEdit">
    
                            <label for="" class="mt-2">currency_type</label>
                            <input type="text" class="form-control mt-1" v-model="modalData.currency_type" :disabled="!allowEdit">
    
                            <label for="" class="mt-2">price</label>
                            <input type="text" class="form-control mt-1" v-model="modalData.price" :disabled="!allowEdit">
    
                            <label for="" class="mt-2">discount</label>
                            <input type="text" class="form-control mt-1" v-model="modalData.discount" :disabled="!allowEdit">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-dark" @click="allowEdit=!allowEdit">edit</button>
                            <button type="button" class="btn btn-dark" @click="updateProduct(modalData.id)">save</button>
                        </div>
                        </div>
                    </div>
                </div>
            </Transition>
        </div>
</template>
<script>
export default{
    data(){
        return {
            allowEdit:false,
            showModal:false,
            modalData:{},
            products: [],
            productLoading: true,
            showAlertStatus:false,
            showAlertMessage:'',
        }
    },
    created(){
        this.fetchData()
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
        showEditProduct(index){
            this.modalData = this.products[index];
            this.showModal = 1;
        },
        updateProduct(id){
            axios.put(`/api/admin/dashboard/products/${id}`,  this.modalData).then((res)=>{
                this.toggleShowAlert('updated');
                this.fetchData();
            });
        },
        deleteProduct(id){
            axios.delete(`/api/admin/dashboard/products/${id}`).then((res)=>{
                console.log(res.data);
                this.toggleShowAlert('deleted');
                this.fetchData();
            });
        }
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