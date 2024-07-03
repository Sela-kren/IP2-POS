<template>
  <div class="w-screen h-full flex">
      <SideBar class="w-1/5"></SideBar>
      <div class="w-full">
          <Header></Header>
          <div class="flex-1  bg-[#D9D9D9] px-8 flex-col pt-4"> 
              
              <router-view />
          </div> 
      </div> 
  </div>
</template>

<script>
import axios from 'axios';
import SideBar from '../components/pages/SideBar.vue';
import Header from '../components/pages/Header.vue';
import Product from '@/components/pages/Product.vue';
import InventoryTable from '@/components/pages/InventoryTable.vue';

import { RouterView } from 'vue-router';
export default {
name: "manageUser",
components: {
  SideBar,
  Header,
  Product,
  InventoryTable
},
data() {
  return {
    products: [],
    categories: [],
    filteredProducts: [],
    selectedCategory: null
  };
},
mounted() {
  this.fetchProducts();
  this.fetchCategories();
},
methods: {
  async fetchProducts() {
    try {
      const response = await axios.get('http://127.0.0.1:8000/api/products/all');
      this.products = response.data;
      this.filteredProducts = this.products;
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
      this.filteredProducts = this.products;
    } else {
      this.filteredProducts = this.products.filter(product => product.type_id === id);
    }
    this.selectedCategory = id;
  }
}
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Quicksand:wght@300;400&display=swap");

.container {
font-family: Quicksand;
}
</style>




