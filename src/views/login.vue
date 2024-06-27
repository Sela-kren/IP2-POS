<template>
    <div class="flex items-center justify-center h-screen bg-gray-100">
      <div class="w-full max-w-sm">
        <form @submit.prevent="handleLogin" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
              Username
            </label>
            <input v-model="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username" required>
          </div>
          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
              Password
            </label>
            <input v-model="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************" required>
          </div>
          <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
              Sign In
            </button>
            <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
              Forgot Password?
            </a>
          </div>
        </form>
        <p class="text-center text-gray-500 text-xs">
          &copy;2023 Your Company. All rights reserved.
        </p>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        username: '',
        password: ''
      };
    },
    methods: {
      async handleLogin() {
        try {
          const response = await axios.post('http://127.0.0.1:8000/api/login', {
            username: this.username,
            password: this.password
          });
  
          const result = response.data;
  
          if (response.status === 200) {
            // Handle successful login, e.g., store the token, redirect to another page, etc.
            console.log('Login successful:', result);
            localStorage.setItem('token', result.access_token);
            this.$router.push('/'); // or any route you want to redirect to
          } else {
            // Handle errors, e.g., show error messages
            console.error('Login failed:', result);
            alert(result.message || 'Login failed!');
          }
        } catch (error) {
          console.error('Error:', error);
          alert('An error occurred. Please try again.');
        }
      }
    }
  };
  </script>
  
  <style scoped>
  /* Add any additional styles if needed */
  </style>
  