<template>
  <div class="w-screen h-full flex">
    <SideBar class="w-1/5"></SideBar>
    <div class="w-full">
      <Header></Header>
      <div class="flex-1 bg-[#D9D9D9] px-8 flex-col pt-4">
        <div class="flex items-center space-x-2.5">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-[30px] h-[30px] text-black font-bold" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="w-[20px] h-[20px] font-bold text-black" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
          </svg>
          <p class="text-16 font-bold">Order</p>
        </div>
        <div class="w-w-6/12 h-[898px] overflow-y-auto bg-white mt-4 flex  flex-col">
        <div class="flex justify-between px-4 py-4">
            <div class="flex font-bold pt-2">

                <p class="text-[16px] ml-4">Order</p>
            </div> 
        </div>
        <div class="grid grid-rows-5 w-full ">
          <div class="w-full h-[60px] font-semibold bg-[#0F172A] flex items-center text-white px-5 justify-around">
              <p class=" text-center w-1/5">receipt number</p>
              <p class=" text-center w-1/5">Chasier ID</p>
              <p class=" text-center w-1/5">Chasier Name</p>
              <p class=" text-center w-1/5">Total Price</p>
              <p class=" text-center w-1/5">Create at</p>
          </div>
          <!-- {{ this.promotions }} -->
          <!-- {{ this.id }} -->
        <!-- Repeat the above <div> block for each row you need -->
          <orderTable v-for="order in orders" :name="order.cashier.name"  :id="order.cashier.id" :receipt_number="order.receipt_number" :total="order.total_price" :create_at="order.created_at"
          :details="order.order_details"
          ></orderTable>
      </div>            
    </div>
      </div>
    </div>
  </div> 
</template>


<script>
    import axios from 'axios';
    import SideBar from '@/components/pages/SideBar.vue';
    import Header from '@/components/pages/Header.vue';
    import Product from '@/components/pages/Product.vue';
    import InventoryTable from '@/components/pages/InventoryTable.vue';
    import promotionTable from '@/components/pages/promotionTable.vue';
    import historyTable from '@/components/pages/promotionTable.vue';
    import orderTable from '@/components/pages/orderTable.vue';
    export default {
    name: "orderpage",
    components: {
    SideBar,
    Header,
    Product,
    orderTable
    },
    data() {
    return {
        orders: [],
    };
    },
    mounted() {
    this.fetchOrders();
    },
    methods: {
    async fetchOrders() {
        try {
        const response = await axios.get('http://127.0.0.1:8000/api/getallorder');
        this.orders = response.data;
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

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Quicksand:wght@300;400&display=swap");

@import url("https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Lato:ital,wght@0,300;0,400;1,300&family=Quicksand:wght@300;400&display=swap");

.container{
    font-family: Quicksand;
}
</style>