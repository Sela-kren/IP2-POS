<template>
  <div class="h-[350px] relative border rounded-[10px] px-4 py-4 flex flex-col text-black transform scale-[0.75] md:scale-[1]">
    <div v-if="this.promotion > 0" class="absolute left-0 top-5 bg-orange-500 text-white h-7 px-8 rounded-r-md">{{ promotion}}%</div>
    <div v-else class="absolute left-0 top-5 bg-transparent text-white w-20 h-7 px-8"></div>
    <img class="img bg-slate-50 h-3/4 object-scale-down" :src="imageUrl" alt="Product Image">
    <p class="category flex justify-start mt-1 text-sm">{{ type.name }}</p>
    <p class="title flex justify-start font-bold text-md w-[220px]">{{ name }} </p>
    <div class="flex justify-between">
      <div class="flex text-[20px]">
        <p class="price mt-1 text-[#009C22] text-md">{{ unitPrice }}</p>
        <p class="price mt-1 ml-1 text-[#009C22] text-md">$</p>
      </div>
      <font-awesome-icon icon="cart-plus" class="mt-1 text-[#009C22] w-[25px] h-[25px]" />
    </div>
  </div>
</template>

<script>
import { RouterLink, RouterView } from 'vue-router';
import axios from 'axios';

export default {
  name: "Product",
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
    },
    promotion: {
      type: Number,
      required: false,
      default: 0
    }
  },
  computed: {
    imageUrl() {
      return this.image ? this.image : '../../assets/images/default.jpg';
    },
    promotionWithDefault() {
      return this.promotion !== null ? this.promotion : 0;
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
        console.log(this.type);
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    }
  }
};
</script>
