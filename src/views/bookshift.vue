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
          <p class="text-16 font-bold">Book Shift</p>
        </div>
        <div class="h-[898px] bg-white mt-4 flex py-4 px-8 w-full justify-between">
          <div class="w-3/5">
            <div class="flex space-x-4 mb-8">
              <div @click="filterProducts(null)" :class="{ 'bg-[#FF5E01] text-white': selectedCategory === null }" class="w-[70px] h-10 bg-[#D9D9D9] rounded-[30px] flex items-center justify-center cursor-pointer">All</div>
              <div v-for="c in categories" :key="c.id" @click="filterProducts(c.id)" :class="{ 'bg-[#FF5E01] text-white': selectedCategory === c.id }" class="px-10 h-10 bg-[#D9D9D9] rounded-[30px] flex items-center justify-center cursor-pointer">{{c.name}}</div>
            </div>
            <div class="grid grid-cols-3 ">

              <Product class="w-5/6" v-for="product in filteredProducts" :key="product.id" 
                    :type_id="product.type_id" :name="product.name" :image="`http://127.0.0.1:8000/storage/${product.image}`" 
                    :category="product.product_type.name" :promotion="product.promotion.discount_percentage"
                    :unitPrice="product.unit_price" @click="addToCart(product)"></Product>
            </div>
          </div>
          <div class="flex mb-12 w-2/5 border rounded-md flex-col p-4">
            <div class="w-full bg-transparent rounded-md border border-stroke dark:border-dark-3 mb-3 py-[10px] px-5 text-dark-6 outline-none transition 
            focus:border-primary active:border-primary disabled:cursor-default disabled:bg-gray-2 disabled:border-gray-2
            ocus:outline-none focus:border-orange-500 focus:ring-orange-500
            ">Cashier:  {{ this.users.name }}
            </div>
            <div class="gap-2 w-full flex flex-col justify-between h-5/6 mt-4 bg-transparent border-y border-stroke dark:border-dark-3 mb-3 py-[10px] px-2 text-dark-6 outline-none transition 
            focus:border-primary active:border-primary disabled:cursor-default disabled:bg-gray-2 disabled:border-gray-2
            ocus:outline-none
            ">
              <div class="w-full h-3/4 mb-20">
                <div class="flex justify-between mb-6 mt-2">
                  <p class=" font-semibold">Product Add <span class=" bg-orange-500 text-white  px-[5px]  rounded-full">{{ cart.length }}</span></p>
                  <button type="submit" @click="clearCart" class="flex text-orange-500 items-center gap-2">
                    <svg width="14" height="14" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M1.5 15L0 13.5L6 7.5L0 1.5L1.5 0L7.5 6L13.5 0L15 1.5L9 7.5L15 13.5L13.5 15L7.5 9L1.5 15Z" fill="#FF5E01"/>
                    </svg>
                    <p class="text-">clears all</p>
                  </button>
                </div>
                <div class="p-3 bg-slate-100 h-full flex flex-col gap-2 overflow-y-scroll">
                  <POFcart
                    v-for="item in cart"
                    :key="item.code"
                    :type_id="item.type_id"
                    :code="item.code"
                    :name="item.name"
                    :image="`http://127.0.0.1:8000/storage/${item.image}`"
                    :unitPrice="item.unit_price"
                    :promotion="item.promotion.discount_percentage"
                    :stock="item.stock"
                    @update-stock="updateStock"
                    @delete-product="deleteProduct"
                  ></POFcart>
                </div>
              </div>
              <div class="text-lg font-medium bg-transparent h-1/6 flex items-center justify-between border-t">
                <p>Grand Total</p>
                <p>{{ calculateTotal() }}$</p>
              </div>
            </div>
            <div class="w-full flex justify-end">
              <button type="submit" @click="checkout" class="flex w-[150px] bg-orange-500 text-sm text-white font-medium h-[45px] border-2 rounded-md items-center justify-center space-x-4">
                Check out
              </button>
            </div>
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
import POFcart from '../components/pages/POFcart.vue';

export default {
  name: "bookshift",
  components: {
    SideBar,
    Header,
    Product,
    POFcart
  },
  data() {
    return {
      products: [],
      categories: [],
      filteredProducts: [],
      selectedCategory: null,
      cart: [],
      users: {}
    };
  },
  mounted() {
    this.fetchProducts();
    this.fetchCategories();
    this.fetchUserData();
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
    fetchUserData() {
      axios.get('http://127.0.0.1:8000/api/profile', {
        headers: {
          'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
      })
      .then(response => {
        this.users = response.data; // Assuming response.data contains the user object
      })
      .catch(error => {
        console.error('Error fetching user data:', error);
      });
    },
    filterProducts(id) {
      if (id === null) {
        this.filteredProducts = this.products;
      } else {
        this.filteredProducts = this.products.filter(product => product.type_id === id);
      }
      this.selectedCategory = id;
    },
    addToCart(product) {
      const existingProduct = this.cart.find(item => item.code === product.code);
      if (existingProduct) {
        existingProduct.stock += 1;
      } else {
        this.cart.push({ ...product, stock: 1 });
      }
    },
    updateStock({ id, increment }) {
      const product = this.cart.find(item => item.code === id);
      if (product) {
        if (increment) {
          product.stock += 1;
        } else if (product.stock > 0) {
          product.stock -= 1;
        }
      }
    },    
    clearCart() {
      this.cart = [];
      
    },
    deleteProduct(code) {
      this.cart = this.cart.filter(item => item.code !== code);
    },
    calculateTotal() {
      return this.cart.reduce((total, product) => {
        const discount = product.promotion.discount_percentage / 100;
        const discountedPrice = product.unit_price * (1 - discount);
        return total + (discountedPrice * product.stock);
      }, 0).toFixed(2);
    },
    async checkout() {
      try {
        // Assuming you have stored the token in Vuex state or localStorage
        const token = localStorage.getItem('token'); // Example: Replace with your actual storage method

        // Transform cart data into the required format
        let cart2 = {};
        this.cart.forEach((item) => {
          cart2[item.id] = item.stock;
        });
        console.log(cart2)
        const response = await axios.post('http://127.0.0.1:8000/api/orders', {
          cart: JSON.stringify(cart2)  // Send as JSON string
        }, {
          headers: {
            'Authorization': `Bearer ${token}`  // Include Bearer token in the header
          }
        });

        // console.log('Order created:', response.data);
        alert('data have bean create');
        this.clearCart();
      } catch (error) {
        console.error('Error creating order:', error);
      }
    }
  }
};
</script>
