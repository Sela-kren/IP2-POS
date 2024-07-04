<template>
  <div class="h-[60px] bg-white flex items-center shadow-sm px-[20px] w-full py-[10px] border-b">
    <!-- Menu -->
    <!-- <div class="cursor-pointer w-[30px]" @click="toggleSideBar">
      <svg class="w-[25px] h-[25px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M18.031 16.6168L22.3137 20.8995L20.8995 22.3137L16.6168 18.031C15.0769 19.263 13.124 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20 13.124 19.263 15.0769 18.031 16.6168ZM16.0247 15.8748C17.2475 14.6146 18 12.8956 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18C12.8956 18 14.6146 17.2475 15.8748 16.0247L16.0247 15.8748Z">
        </path></svg>
    </div> -->
    <!-- search bar -->
    <div class="w-[calc(100%-100px)] flex py-[10px]">
      <div class="w-[calc(100%-200px)] flex justify-center">
        <form class="flex items-center w-[500px]">
          <label for="voice-search" class="sr-only text-gray-400">Search</label>
          <div class="relative w-full">
            <div class="flex absolute inset-y-0 left-0 items-center mt-[10px] pl-3 pointer-events-none">
              <svg aria-hidden="true" class="w-5 h-auto text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="M18.031 16.6168L22.3137 20.8995L20.8995 22.3137L16.6168 18.031C15.0769 19.263 13.124 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20 13.124 19.263 15.0769 18.031 16.6168ZM16.0247 15.8748C17.2475 14.6146 18 12.8956 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18C12.8956 18 14.6146 17.2475 15.8748 16.0247L16.0247 15.8748Z">
                </path></svg>
            </div>
            <input type="text" name="" id="" class="h-[40px] w-full bg-[#DADADA] border-none border-gray-300 text-gray-900 text-sm rounded-[50px] focus:ring-blue-500 focus:border-blue-500 block pl-10">
          </div>
        </form>
      </div>
      <div class="w-[200px] justify-end">
        <div class="flex items-center justify-start space-x-15 pl-[50px]">
          <img class="w-10 h-10 rounded-full border-2 border-gray-50" :src="`http://127.0.0.1:8000${users.avatar}`" alt="">
          <div class="font-semibold dark:text-black text-left">
            <h1 v-if="users.name">Welcome, {{ users.name }}</h1>
            <div class="text-xs text-gray-500 dark:text-gray-400">{{users.email}}</div>
          </div>
          <!-- Logout Button -->
          <button @click="logout" class="ml-4 bg-red-500 text-white px-4 py-2 rounded">Logout</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      users: {} // Initialize users as an object
    };
  },
  mounted() {
    this.fetchUserData();
  },
  methods: {
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
    logout() {
  localStorage.removeItem('token');
  this.$router.push('/login');
}
  }
};
</script>

<style>
/* Add your styles here */
</style>
