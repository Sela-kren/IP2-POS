<template>
  <div class="flex justify-between">
    <div class="flex items-center space-x-2.5">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-[24px] h-[24px] text-black text-bold" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
      </svg>
      <svg xmlns="http://www.w3.org/2000/svg" class="w-[20px] h-[20px] text-bold text-black" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
      </svg>
      <p class="text-16 font-bold">Inventory</p>
    </div>
    <button type="submit" class="flex w-[150px] bg-white text-sm text-gray-800 font-medium h-[35px] border-2 border-[#D9D9D9] rounded-md items-center justify-center space-x-4" @click="deletePromotion">
      Clear Promo
    </button>
  </div>
  <div class="w-w-6/12 h-[898px] bg-white mt-4 rounded-t-md">
    <form @submit.prevent="updateUser" class="flex justify-between px-16 py-10">
      <div class="flex flex-col items-center h-full w-1/2">
        <img class="w-full object-contain h-[300px] pb-3 bg-slate-50 mt-11" :src="`http://127.0.0.1:8000/storage/${user.image}`" alt="">
        <div class="mb-3 w-full">
          <label for="" class="mb-[8px] block text-sm font-medium">Image</label>
          <input type="file" class="w-full cursor-pointer rounded-lg border-[1.5px] border-stroke dark:border-dark-3 font-medium text-body-color dark:text-dark-6 outline-none transition file:mr-2 file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-stroke dark:file:border-dark-3 file:bg-[#F5F7FD] dark:file:bg-dark-2 file:py-3 file:px-3 file:text-sm file:text-body-color dark:file:text-dark-6 file:hover:bg-primary file:hover:bg-opacity-10 focus:border-primary active:border-primary disabled:cursor-default disabled:bg-[#F5F7FD]" @change="handleImageUpload" accept="image/*" />
        </div>
      </div>
      <div class="flex flex-col items-center h-full w-1/2 pl-10">
        <div class="mb-3 w-full">
          <label for="" class="mb-[8px] block text-sm font-medium">Name</label>
          <input required v-model="user.name" type="text" placeholder="Default Input" class="w-full bg-transparent rounded-md border border-stroke dark:border-dark-3 py-[10px] px-5 text-dark-6 outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-gray-2 disabled:border-gray-2 focus:outline-none focus:border-orange-500 focus:ring-orange-500" />
        </div>
        <div class="mb-3 w-full">
          <label for="" class="mb-[8px] block text-sm font-medium">Roles</label>
          <div class="relative z-20">
            <select v-model="user.type_id" class="relative z-20 w-full appearance-none rounded-lg border border-stroke dark:border-dark-3 bg-transparent py-[10px] px-5 text-dark-6 outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-gray-2">
              <option v-for="c in categories" :key="c.id" :value="c.id" class="dark:bg-dark-2">{{ c.name }}</option>
            </select>
            <span class="absolute right-4 top-1/2 z-10 mt-[-2px] h-[10px] w-[10px] -translate-y-1/2 rotate-45 border-r-2 border-b-2 border-body-color"></span>
          </div>
        </div>
        <div class="mb-3 w-full">
          <label for="" class="mb-[8px] block text-sm font-medium">Phone</label>
          <input required v-model="user.phone" type="text" placeholder="Default Input" class="w-full bg-transparent rounded-md border border-stroke dark:border-dark-3 py-[10px] px-5 text-dark-6 outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-gray-2 disabled:border-gray-2 focus:outline-none focus:border-orange-500 focus:ring-orange-500" />
        </div>
        <div class="mb-3 w-full">
          <label for="" class="mb-[8px] block text-sm font-medium">Email</label>
          <input required v-model="user.email" type="text" placeholder="Default Input" class="w-full bg-transparent rounded-md border border-stroke dark:border-dark-3 py-[10px] px-5 text-dark-6 outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-gray-2 disabled:border-gray-2 focus:outline-none focus:border-orange-500 focus:ring-orange-500" />
        </div>
        <div class="mb-3 w-full">
          <label for="" class="mb-[8px] block text-sm font-medium">Is Active</label>
          <input required v-model="user.is_active" type="text" placeholder="Default Input" class="w-full bg-transparent rounded-md border border-stroke dark:border-dark-3 py-[10px] px-5 text-dark-6 outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-gray-2 disabled:border-gray-2 focus:outline-none focus:border-orange-500 focus:ring-orange-500" />
        </div>
        <button class="bg-orange-500 w-full dark:bg-dark-2 border-dark dark:border-dark-2 border mt-2 rounded-md inline-flex items-center justify-center py-3 px-7 text-center text-base font-medium text-white hover:bg-body-color hover:border-body-color disabled:bg-gray-3 disabled:border-gray-3 disabled:text-dark-5" type="submit">Update user</button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      categories: [
        { id: 1, name: 'Admin' },
        { id: 2, name: 'Staff' }
      ],
      userId: 1, // Replace with actual user ID
      user: {
        type_id: '',
        type_name: '',
        name: '',
        image: null,
        email: '',
        phone: '',
        is_active: '',
      },
      promotion: {
        id: '',
        name: '',
        discount_percentage: '',
        start_date: '',
        end_date: ''
      }
    };
  },
  mounted(){
    this.fetchCategories();
    this.fetchUser();
  },
  props: ['id'],
  methods: {
    async fetchUser() {
      try {
        const response = await axios.get(`http://127.0.0.1:8000/api/user/${this.id}`, {
          params: {
            exclude: 'promotion'  // Assuming your Laravel API supports this parameter
          }
        });
        this.user = response.data;
      } catch (error) {
        console.error('Error fetching user:', error);
      }
    },
    async fetchPromtion(){
      try {
        const response = await axios.get(`http://127.0.0.1:8000/api/promotion/${this.id}`);
        this.promotion = response.data;
      } catch (error) {
        console.error('Error fetching user:', error);
      }
    },
    async fetchCategories() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/user_types');
        this.categories = response.data.map(category => ({
          id: category.id,
          name: category.name
        }));
      } catch (error) {
        console.error('Error fetching categories:', error);
      }
    },
    async updateUser() {
      try {
        const formData = new FormData();
        formData.append('type_id', this.user.type_id);
        formData.append('name', this.user.name);
        if (this.user.image instanceof File) {
          formData.append('image', this.user.image, this.user.image.name);
        }
        formData.append('email', this.user.email);
        formData.append('phone', this.user.phone);
        formData.append('is_active', this.user.is_active);

        const response = await axios.post(`http://127.0.0.1:8000/api/user/update/${this.id}`, formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          }
        });

        console.log(response.data); // Log the response for debugging
        alert('User updated successfully!');
        this.$router.push('/user');
      } catch (error) {
        console.error('Error updating user:', error);
        if (error.response) {
          console.log('Validation errors:', error.response.data.errors); // Check Laravel validation errors
        }
        alert('Failed to update user. Please try again.');
      }
    },
    handleImageUpload(event) {
      const file = event.target.files[0];
      this.user.image = file;
    },
  }
};
</script>

<style scoped>
/* Add your component-specific styles here */
</style>

