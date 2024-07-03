<!-- <template>
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
            alert(result.message || 'Login sucessfully!');
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
   -->


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
              <input v-model="password" class="shadow appearance-none border rounded h-[50px] py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="**********" required>
            </div>
  
            <!-- Sign In Button -->
            <div class="flex items-center justify-between pl-5 pt-5">
              <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Sign In
              </button>
            </div>
          </form>
        </div>
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
          localStorage.setItem('user', JSON.stringify(result.user));
          alert(result.message || 'Login sucessfully!');
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
@import url("https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Quicksand:wght@300;400&display=swap");

@import url("https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Lato:ital,wght@0,300;0,400;1,300&family=Quicksand:wght@300;400&display=swap");

.container{
    font-family: Quicksand;
}
</style>