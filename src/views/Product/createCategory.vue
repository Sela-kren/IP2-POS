<template>  
  <div class="flex">
    <div class="flex items-center space-x-2.5">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-[24px] h-[24px] text-black text-bold" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
                      <path strokeLinecap="round" strokeLinejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-[20px] h-[20px] text-bold text-black " fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                      <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                  </svg>
                  <p class="text-16 font-bold">Inventory</p>
  </div>
  </div>
  <div class="w-w-6/12 h-[898px] bg-white mt-4">
  <form @submit.prevent="updateProduct" class="flex justify-between px-16 py-10">
    <div class="flex flex-col items-center h-full w-1/2">
      <div class="w-full h-[300px] bg-green-50 mt-11">
      </div>
      <!-- handle leftside -->
     

    </div>
    <div class="flex flex-col items-center h-full w-1/2 pl-10">
      <!-- handle right side -->
      <div class="mb-3 w-full">
        <label for="" class="mb-[8px] block text-sm font-medium">
          Name
        </label>
        <input
          required
          v-model="product.name"
          type="text"
          placeholder="Default Input"
          class="w-full bg-transparent rounded-md border border-stroke dark:border-dark-3 py-[10px] px-5 text-dark-6 outline-none transition 
          focus:border-primary active:border-primary disabled:cursor-default disabled:bg-gray-2 disabled:border-gray-2
          ocus:outline-none focus:border-orange-500 focus:ring-orange-500
          "
        />
      </div> 
      <div class="mb-3 w-full">
          <label for="" class="mb-[8px] block text-sm font-medium">
              Image
          </label>
          <input
              type="file"
              class="w-full cursor-pointer rounded-lg border-[1.5px]
              border-stroke dark:border-dark-3 font-medium text-body-color dark:text-dark-6 outline-none transition file:mr-2 
              file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-stroke dark:file:border-dark-3 
              file:bg-[#F5F7FD] dark:file:bg-dark-2 file:py-3 file:px-3 file:text-sm file:text-body-color dark:file:text-dark-6 file:hover:bg-primary 
              file:hover:bg-opacity-10 focus:border-primary active:border-primary disabled:cursor-default disabled:bg-[#F5F7FD]"
              @change="handleImageUpload" accept="image/*"
          />
      </div>
      <button class="bg-orange-500 w-full dark:bg-dark-2 border-dark dark:border-dark-2 border  mt-2
      rounded-md inline-flex items-center justify-center py-3 px-7 text-center text-base font-medium 
      text-white hover:bg-body-color hover:border-body-color disabled:bg-gray-3 disabled:border-gray-3 disabled:text-dark-5"
      type="submit">Create Category</button>
    </div>
  </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      categories: [],
      productId: 1, // Replace with actual product ID
      product: {
        code: '',
        type_id: '',
        name: '',
        image: null,
        unit_price: '',
        stock: '',
        description: '',
      },
      promotion: {
        name: '',
        discount_percentage: '',
        start_date: '',
        end_date: ''
      }
    };
  },
  mounted(){
    this.fetchCategories();
  },
  props: ['id'],
  methods: {
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
    async updateProduct() {
    try {
    const formData = new FormData();
    formData.append('name', this.product.name);
    if (this.product.image) {
      formData.append('image', this.product.image, this.product.image.name);
    }

    const response = await axios.post(`http://127.0.0.1:8000/api/product-types/create`, formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      }
    });

    console.log(response.data); // Log the response for debugging
      alert('Product updated successfully!');
      this.$router.push('/manage');
  } catch (error) {
    console.error('Error updating product:', error);
    if (error.response) {
      console.log('Validation errors:', error.response.data.errors); // Check Laravel validation errors
    }
    alert('Failed to update product. Please try again.');
  }
  
  },
  handleImageUpload(event) {
    const file = event.target.files[0];
    this.product.image = file;
  },
  }
};
</script>

<style scoped>
/* Add your component-specific styles here */
</style>
