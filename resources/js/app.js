import './bootstrap';
import { createApp } from 'vue';
import MainContent from './components/MainContent.vue';
import ProductsContent from './components/ProductsContent.vue';
import { createRouter , createWebHistory } from 'vue-router';
import MainPage from './components/MainPage.vue';
import Dashboard from './components/Dashboard.vue';
import NavBar from './components/NavBar.vue';
import AddCategory from './components/dashboard/AddCategory.vue';
import AddProduct from './components/dashboard/AddProduct.vue';
import Products from './components/dashboard/Products.vue';
import ProductData from './components/dashboard/ProductData.vue';


const routes = [
  { path: '/', components: {
    NavBar,
    default:MainContent
    }
  },
  { path: '/:type/:category?/:subcategory?', 
    components:{
      NavBar,
      default: ProductsContent,
    }  
  },
  { path: '/admin/dashboard/', 
    component:Dashboard,
    redirect: '/admin/dashboard/addproduct',
    children:[
      {path:'addcategory', component:AddCategory,},
      {path:'addproduct', component:AddProduct},
      {path:'products', component:Products},
      {path:'productdata', component:ProductData}

    ]

  },
  // { path:'/:pathName(.*)', component: MainContent },
];
const router = createRouter({
  history: createWebHistory(),
  routes,
})
const app = createApp({
    data(){
      return{
      }
    },
    components:{
        NavBar,
        MainPage,
        MainContent,
        ProductsContent,
        Dashboard,
        AddCategory,
        AddProduct,
        Products,
        ProductData
    },
    methods:{
    },

});
app.use(router);
app.mount('#app');
