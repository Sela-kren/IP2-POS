<template>
    <div class="w-screen h-full flex">
        <SideBar></SideBar>
        <div class="w-full">
            <Header></Header>
            <div class="flex-1  bg-[#D9D9D9] px-8 flex-col pt-4"> 
                <div class="flex items-center space-x-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[30px] h-[30px] text-black text-bold" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
                        <path strokeLinecap="round" strokeLinejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[20px] h-[20px] text-bold text-black " fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                    <p class="text-16 font-bold">Book Shift</p>
                </div>
                <div class=" h-[898px] bg-white mt-4 flex py-4 px-8 flex-col">
                <div class="w-w-6/12 h-[898px] bg-white mt-4 flex py-4 px-8 flex-col">
                    <!-- catecory box -->
                    <div class="flex space-x-8">
                        <div  @click="filterProducts(null)" 
                        :class="{ 'bg-[#FF5E01] text-white': selectedCategory === null }"
                        class="w-[70px] h-10 bg-[#D9D9D9]  rounded-[30px] flex items-center justify-center">All</div>
                        <div  v-for="c in categories" @click="filterProducts(c.id)"
                        :class="{ 'bg-[#FF5E01] text-white': selectedCategory === c.id }"
                        class="w-40 h-10 bg-[#D9D9D9] rounded-[30px] flex items-center justify-center">{{c.name}}</div>
                        
                    </div>
                    <div class="mt-8 grid grid-cols-6 gap-8 min-w-[1500px] overflow-y-auto ">
                        <Product v-for="product in filteredProducts" :type_id="product.type_id" :key="product.id" :name="product.name" :image="`http://127.0.0.1:8000/storage/` + product.image"
                            :unitPrice="product.unit_price"
                        ></Product>
                    </div>
                    
                </div>
            </div> 
        </div> 
    </div>
</template>

<script>
import axios from 'axios';
import SideBar from '../components/pages/SideBar.vue';
import Header from '../components/pages/Header.vue';
import Product from '@/components/pages/Product.vue';

export default {
  name: "bookshift",
  components: {
    SideBar,
    Header,
    Product
  },
  data() {
    return {
      products: [],
      categories: [],
      filteredProducts:[],
      selectedCategory: null
    };
  },
  mounted() {
    this.fetchProducts();
    this.fetchCategories();
    // console.error(this.products);
  },
  methods: {
    async fetchProducts() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/products');
        this.products = response.data;
        this.filteredProducts =  this.products;
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    },
    async fetchCategories() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/product_types');
        this.categories = response.data.map(category => ({
          id: category.id,
          name: category.name
        }));
      } catch (error) {
        console.error('Error fetching categories:', error);
      }
    },    
    filterProducts(id) {
            if (id === null) {
                // Filter for 'All' selected
                this.filteredProducts = this.products;
                
            } else {
                // Filter based on the selected category
                this.filteredProducts = this.products.filter(product => product.type_id === id);
            }
            this.selectedCategory = id;
        }
  },
  
  
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Quicksand:wght@300;400&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Lato:ital,wght@0,300;0,400;1,300&family=Quicksand:wght@300;400&display=swap");

.container {
  font-family: Quicksand;
}
</style>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Quicksand:wght@300;400&display=swap");

@import url("https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Lato:ital,wght@0,300;0,400;1,300&family=Quicksand:wght@300;400&display=swap");

.container{
    font-family: Quicksand;
}


</style>