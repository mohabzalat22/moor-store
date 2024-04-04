<template>
    <div class="col-12 col-lg-10">
        <div class="col-12 col-lg-6 offset-lg-6">
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
        </div>
        <p class="h1 text-dark">Add New Category</p>
        <div class="p-4">
            <div class="row mt-3">
                <div class="col-12 col-lg-3">
                    <label for="" class="text-capitalize my-1">type</label>
                    <select class="form-select" v-model="type">
                        <option value="new">new</option>
                        <option value="men">men</option>
                        <option value="women">women</option>
                        <option value="kids">kids</option>
                    </select>
                </div>
                <div class="col-12 col-lg-3">
                    <label for="" class="text-capitalize my-1">category</label>
                    <select class="form-select" v-model="category">
                        <option value="shoes">shoes</option>
                        <option value="clothing">clothing</option>
                        <option value="accessories">accessories</option>
                    </select>
                </div>
                <div class="col-12 col-lg-4">
                    <label for="" class="text-capitalize my-1">subCategory</label>
                    <input type="text" class="form-control" v-model.trim="subcategory">
                </div>
                <div class="col-12 col-lg-2 d-flex align-items-end" @click="submitCategory($event)">
                    <button class="btn btn-dark rounded-pill w-100 mt-3">save</button>
                </div>
            </div>
            <div class="d-flex justify-content-center w-100" v-if="loading == true">
                <div class="spinner-grow text-dark mt-5" role="status" >
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="row mt-3 table-responsive" v-else>
                <div class="alert alert-success d-none" role="alert">
                    Updated
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col"><p class="text-uppercase m-0">id</p></th>
                        <th scope="col"><p class="text-capitalize m-0">type</p></th>
                        <th scope="col"><p class="text-capitalize m-0">category</p></th>
                        <th scope="col"><p class="text-capitalize m-0">subcategory</p></th>
                        <th scope="col"><p class="text-capitalize m-0">edit</p></th>
                        <th scope="col"><p class="text-capitalize m-0">delete</p></th>

                        </tr>
                    </thead>
                    <tbody class="table-striped">
                        <tr v-for="(item, index) in categories">
                            <th  scope="row">{{index + 1 }}</th>
                            <td>{{ item.type }}</td>
                            <td>{{ item.category }}</td>
                            <td>{{ item.subcategory }}</td>
                            <td> <button class="btn btn-success text-capitalize" @click="editCategory(index)">edit</button> </td>
                            <td> <button class="btn btn-danger text-capitalize" @click="deleteCategory(item.id)">delete</button> </td>
                        </tr>
                    </tbody>
                </table>
                <!-- modal -->
                <Transition>
                    <div class="modal d-block" tabindex="-1" v-if="showModal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Modal title</h5>
                                <button type="button" class="btn-close" @click="showModal=0"></button>
                            </div>
                            <div class="modal-body">
                                <label for="" class="mt-2">type</label>
                                <input type="text" class="form-control mt-1" v-model="modalData.type">

                                <label for="" class="mt-2">category</label>
                                <input type="text" class="form-control mt-1" v-model="modalData.category">

                                <label for="" class="mt-2">subcategory</label>
                                <input type="text" class="form-control mt-1" v-model="modalData.subcategory">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark rounded-pill" @click="updateCategory(modalData.id)">Save changes</button>
                            </div>
                            </div>
                        </div>
                    </div>            
                </Transition>
            </div>
        </div>
     </div>
</template>
<script>
import axios from 'axios';

export default{
 data(){
     return {
         showModal:0,
         modalData:{},
         loading:true,
         type:'',
         category:'',
         subcategory:'',
         categories:[],
         showAlertStatus:false,
         showAlertMessage:''
     }
 },
 created(){
     this.fetchData();
 },

 methods: {
    toggleShowAlert(value){
        this.showAlertStatus = true;
        this.showAlertMessage = value;
        setTimeout(()=>{
            this.showAlertStatus = false;
            this.showAlertMessage = '';
        }, 2000);

    },
    async fetchData(){
        await axios.get('/api/admin/dashboard/category').then((res)=>{
            this.categories = res.data;
            this.loading = false;
        });
    },
    submitCategory(event){
        event.preventDefault();
        const config = {
            headers: { 'content-type': 'multipart/form-data' }
        };

        let fromData = {'type':this.type,'category':this.category,'subcategory':this.subcategory};
        axios.post('/api/admin/dashboard/category', fromData, config).then((res)=>{
            if(res.status==200){
                this.toggleShowAlert("saved");
                this.fetchData();
            }
        });
    },
    editCategory(index){
        this.showModal=!this.showModal;
        this.modalData = this.categories[index];
    },
    deleteCategory(id){
        axios.delete(`/api/admin/dashboard/category/${id}`).then((res)=>{
            if(res.status==200){
                this.toggleShowAlert("deleted");
                this.fetchData();
            }
        });
    },
    updateCategory(id){
        axios.put(`/api/admin/dashboard/category/${id}`, this.modalData).then((res)=>{
            if(res.status==200){
                this.toggleShowAlert("Updated");
                this.fetchData();
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