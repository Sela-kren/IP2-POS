<template>
    <div class="flex items-center space-x-2.5">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-[24px] h-[24px] text-black text-bold" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
                      <path strokeLinecap="round" strokeLinejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-[20px] h-[20px] text-bold text-black " fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                      <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                  </svg>
                  <p class="text-16 font-bold">Inventory</p>
    </div>
    <div class="w-w-6/12 h-[898px] bg-white mt-4 flex  flex-col">
        <div class="flex justify-between px-4 py-4">
            <div class="flex font-bold pt-2">
                <p class="text-[16px]">7</p>
                <p class="text-[16px] ml-4">Inventory</p>
            </div>
            <router-link :to="'/manage/create'" class="flex w-[150px] h-[45px] text-[#D9D9D9] border-2 border-[#D9D9D9] rounded-md items-center justify-center space-x-4">
                <div class="w-[20px] h-[20px] border rounded-[30px] border-[#948984] flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[20px] h-[20px] text-black" viewBox="0 0 24 24" fill="#948984">
                    <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z"></path></svg>
                </div>
                <p class="text-[20px] text-[#948984]">Create</p>
            </router-link>    
        </div>
        <div class="grid grid-row-8">
            <tr class="w-full h-[60px] bg-[#0F172A] flex items-center text-white">
                <th class="w-3/12 ">Category</th>
                <th class="w-3/12 text-start">Product_id</th>
                <th class="w-3/12 text-start">Title</th>
                <th class="w-1/12 text-start">Price</th>
                <th class="w-2/12">Stock</th>
                <th class="w-2/12">Promotion</th>
                <th class="w-2/6">Date</th>
                <th class="w-1/12">hi</th> 
            </tr>
            <InventoryTable v-for="product in filteredProducts" 
            :key="product.id" :type_id="product.type_id" :name="product.name" :image="`http://127.0.0.1:8000/storage/${product.image}`" 
            :category="product.product_type.name" :promotion="product.promotion.discount_percentage" :end-date="product.promotion.end_date"
            :unitPrice="product.unit_price" :stock="product.stock" :id="product.id" @productDeleted="handleProductDeleted"
            >
            </InventoryTable>

        </div>
                
    </div>
</template>
  
  <script>
  import axios from 'axios';
  import SideBar from '@/components/pages/SideBar.vue';
  import Header from '@/components/pages/Header.vue';
  import Product from '@/components/pages/Product.vue';
  import InventoryTable from '@/components/pages/InventoryTable.vue';
  
  
  export default {
  name: "Manage",
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
        this.products = response.data.map(product => {
          if (product.promotion === null) {
            product.promotion = {
              discount_percentage: 0,
              end_date: 'N/A'
            };
          }
          return product;
        });
        this.filteredProducts = this.products;
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    }
    ,
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
    },
    async handleProductDeleted() {
            // Handle what happens after a product is deleted
            await this.fetchProducts(); // Refresh the product list
    },
  }
  };
  </script>
  
  <style scoped>
  @import url("https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Quicksand:wght@300;400&display=swap");
  
  .container {
  font-family: Quicksand;
  }
  </style>
  
  
  
  
  