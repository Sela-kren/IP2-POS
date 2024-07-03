<template>
  
    <div class="flex items-center space-x-2.5">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-[24px] h-[24px] text-black text-bold" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
                      <path strokeLinecap="round" strokeLinejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-[20px] h-[20px] text-bold text-black " fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                      <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                  </svg>
                  <p class="text-16 font-bold">Inventory / Edit / promotion History</p>
    </div>
    <div class="w-w-6/12 h-[898px] bg-white mt-4 flex  flex-col">
        <div class="flex justify-between px-4 py-4">
            <div class="flex font-bold pt-2">

                <p class="text-[16px] ml-4">History</p>
            </div> 
        </div>
        <div class="grid grid-rows-5 w-full ">
          <div class="w-full h-[60px] bg-[#0F172A] flex items-center text-white px-5 justify-around">
              <p class=" text-center w-1/5">Name</p>
              <p class=" text-center w-1/5">Promotion</p>
              <p class=" text-center w-1/5">Start date</p>
              <p class=" text-center w-1/5">End date</p>
              <p class=" text-center w-1/5">Delete</p>
          </div>
          <!-- {{ this.promotions }} -->
          <!-- {{ this.id }} -->
        <!-- Repeat the above <div> block for each row you need -->
          <promotionTable v-for="promotion in promotions" :name="promotion.name" :promotion="promotion.discount_percentage" :startDate="promotion.start_date"
            :endDate="promotion.end_date" :delete_at="promotion.deleted_at"
          ></promotionTable>
      </div>
                
    </div>
</template>
  
  <script>
  import axios from 'axios';
  import SideBar from '@/components/pages/SideBar.vue';
  import Header from '@/components/pages/Header.vue';
  import Product from '@/components/pages/Product.vue';
  import InventoryTable from '@/components/pages/InventoryTable.vue';
  import promotionTable from '@/components/pages/promotionTable.vue'
  
  export default {
  name: "Promotion History",
  components: {
    SideBar,
    Header,
    Product,
    InventoryTable,
    promotionTable
  },
  data() {
    return {
      promotions: [],
      categories: [],
      filteredProducts: [],
      selectedCategory: null
    };
  },
  props: ['id'],
  mounted() {
    this.fetchProducts();
  },
   methods: {
    async fetchProducts() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/promotionHistory/'+ this.id);
        this.promotions = response.data;
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    }
    ,
  }
  };
  </script>
  
  <style scoped>
  @import url("https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Quicksand:wght@300;400&display=swap");
  
  .container {
  font-family: Quicksand;
  }
  </style>
  
  
  
  
  