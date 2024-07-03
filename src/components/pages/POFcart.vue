<template>
    <div class="h-1/4 w-full bg-white relative px-6 py-2 flex items-center justify-around">
        <div v-if="this.promotion > 0" class="absolute text-sm left-11 top-4 bg-orange-500 text-white px-5 rounded-md">{{ promotion}} %</div>
        <div v-else class="absolute left-0 top-5 bg-transparent text-white w-20 h-7 px-8"></div>
      <div class="h-full w-1/2 flex items-center">
        <img class="img bg-slate-50 h-4/5 object-scale-down" :src="imageUrl" alt="Product Image">
        <div class="h-full w-1/5 mx-[10px] text-sm pt-1">
          <p class="category truncate justify-start mt-1 text-sm">{{ type.name }}</p>
          <p class="title truncate w-[100px] flex justify-start font-bold text-sm ">{{ name }}</p>
          <p class="price mt-1 text-[#009C22] text-md">{{ unitPrice }}</p>
        </div>
      </div>
      <div class="relative flex items-center max-w-[5rem] max-h-[30px] px-2 border rounded-full mx-auto">
        <button type="button" @click="decrementStock" class="bg-transparent">
          <svg class="w-3 h-3 dark:text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
          </svg>
        </button>
        <input type="text" aria-describedby="helper-text-explanation" class="max-h-[30px] bg-transparent border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm block w-full py-2.5" :value="stock" readonly/>
        <button type="button" @click="incrementStock" class="bg-transparent">
          <svg class="w-3 h-3 text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
          </svg>
        </button>
      </div>
      <button type="button" @click="deleteProduct" class="bg-transparent">
        <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M10.2833 6.5L9.995 14M6.005 14L5.71667 6.5M14.0233 3.825C14.3083 3.86833 14.5917 3.91417 14.875 3.96333M14.0233 3.825L13.1333 15.3942C13.097 15.8652 12.8842 16.3051 12.5375 16.626C12.1908 16.9469 11.7358 17.1251 11.2633 17.125H4.73667C4.26425 17.1251 3.80919 16.9469 3.46248 16.626C3.11578 16.3051 2.90299 15.8652 2.86667 15.3942L1.97667 3.825M14.0233 3.825C13.0616 3.6796 12.0948 3.56925 11.125 3.49417M1.97667 3.825C1.69167 3.8675 1.40833 3.91333 1.125 3.9625M1.97667 3.825C2.93844 3.6796 3.9052 3.56925 4.875 3.49417M11.125 3.49417V2.73083C11.125 1.7475 10.3667 0.9275 9.38333 0.896666C8.46135 0.867198 7.53865 0.867198 6.61667 0.896666C5.63333 0.9275 4.875 1.74833 4.875 2.73083V3.49417M11.125 3.49417C9.04477 3.3334 6.95523 3.3334 4.875 3.49417" stroke="#FF5E01" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  export default {
    name: "POFcart",
    data() {
      return {
        type: []
      };
    },
    props: {
      type_id: {
        type: String,
        required: true
      },
      code: {
        type: String,
        required: true
      },
      name: {
        type: String,
        required: true
      },
      image: {
        type: String,
        required: true,
        default: '../../assets/images/default.jpg'
      },
      unitPrice: {
        type: Number,
        required: false
      },
      stock: {
        type: Number,
        required: false,
        default: 0
      },
      description: {
        type: String,
        required: false
      } ,
      promotion:
      {
        type: Number,
        required: false,
        default: 0,
      }
    },
    computed: {
      imageUrl() {
        return this.image ? this.image : '../../assets/images/default.jpg';
      }
    },
    mounted() {
      this.fetchProductsType();
    },
    methods: {
      async fetchProductsType() {
        try {
          const response = await axios.get('http://127.0.0.1:8000/api/product-types/' + this.type_id);
          this.type = response.data;
        } catch (error) {
          console.error('Error fetching products:', error);
        }
      },
      incrementStock() {
        this.$emit('update-stock', { id: this.$props.code, increment: true });
      },
      decrementStock() {
        if (this.stock > 0) {
          this.$emit('update-stock', { id: this.$props.code, increment: false });
        }
      },
      deleteProduct() {
        this.$emit('delete-product', this.$props.code);
      }
    }
  };
  </script>
  