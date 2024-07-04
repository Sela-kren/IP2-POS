<template>
  <div class="w-screen h-screen flex flex-row justify-center items-center">
    <!-- Left Section with Logo -->
    <div class="flex w-1/2 h-screen bg-orange-200 items-center justify-center">
      <img src="../assets/images/logo.png" alt="Logo">
    </div>
    
    <!-- Right Section with Login Form -->
    <div class="flex flex-col w-1/2 h-screen justify-center items-center bg-gray-400">
      <div class="text text-black gap-10">
        <h1 class="pb-5 text-start text-black text-[36px] font-bold">Login</h1>
        <p class="pb-5 text-start text-black text-[32px]">Welcome Back to POS</p>
      </div>

      <!-- Form Section -->
      <div class="flex w-screen justify-center items-center p-10">
        <form @submit.prevent="handleLogin" class="w-full max-w-[500px]">
          <!-- Username Input -->
          <div class="flex flex-col w-full justify-center p-5">
            <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
            <input v-model="username" class="shadow appearance-none border rounded h-[50px] py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username" required>
          </div>

          <!-- Password Input -->
          <div class="flex flex-col w-full justify-center p-5">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <input v-model="password" :type="showPassword ? 'text' : 'password'" class="shadow appearance-none border rounded h-[50px] py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" placeholder="**********" required>
          </div>

          <!-- Sign In Button -->
          <div class="flex items-center justify-between pl-5 pt-5">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" :disabled="loading">
              <span v-if="!loading">Sign In</span>
              <span v-else>Loading...</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { ref } from 'vue';

export default {
  data() {
    return {
      username: '',
      password: '',
      loading: false,
      showPassword: false
    };
  },
  methods: {
    togglePasswordVisibility() {
      this.showPassword = !this.showPassword;
    },
    async handleLogin() {
      this.loading = true;
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/login', {
          username: this.username,
          password: this.password
        });

        const data = response.data;

        if (response.status === 200) {
          localStorage.setItem('token', data.access_token);
          localStorage.setItem('user', JSON.stringify(data.user));

          setTimeout(() => {
            if (data.role === 'Admin') {
              this.$router.push('/');
            } else if (data.role === 'Staff') {
              this.$router.push('/bookshift');
            } else {
              console.warn('Unhandled role:', data.role);
              this.$router.push('/homepage');
            }
            this.loading = false;
          }, 2000);
        } else {
          this.loading = false;
          alert('Login failed. Please check your credentials.');
        }
      } catch (error) {
        this.loading = false;
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
      }
    }
  }
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Quicksand:wght@300;400&display=swap");

@import url("https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Lato:ital,wght@0,300;0,400;1,300&family=Quicksand:wght@300;400&display=swap");

.container {
  font-family: Quicksand;
}
</style>
