<template>
  <div class="flex flex-col w-[626px] h-[554px] pl-5">
    <h2 class="text-2xl font-bold mb-4">Create User</h2>
    <div class="w-[576px] h-[468px] flex flex-row pt-10 justify-center">
      <div class="w-[155px] h-[120px] bg-red-400 mt-2"></div>
      <div class="ml-10">
        <form @submit.prevent="createUser">
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2 " for="name">Full Name</label>
            <input v-model="name" type="text" id="name" class="p-2 border rounded w-full border-gray-300" required />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
            <input v-model="email" type="email" id="email" class="w-[323px] p-2 border rounded border-gray-300" required />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">Phone</label>
            <input v-model="phone" type="text" id="phone" class="w-[323px] p-2 border rounded border-gray-300" required />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
            <input v-model="password" type="password" id="password" class="w-[323px] p-2 border rounded border-gray-300" required />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="type_id">Role</label>
            <select v-model="type_id" id="type_id" class="w-[323px] p-2 border rounded border-gray-300" required>
              <option value="1">Admin</option>
              <option value="2">Staff</option>
            </select>
          </div>
          <div class="flex justify-end space-x-4">
            <button type="button" @click="cancel" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</button>
            <button type="submit" class="bg-[#FF5E01] hover:bg-[#FF5E01] text-white font-bold py-2 px-4 rounded">Create</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "CreateUser",
  data() {
    return {
      name: '',
      email: '',
      phone: '',
      password: '',
      type_id: ''
    };
  },
  methods: {
    async createUser() {
      try {
        // Retrieve token from localStorage
        const token = localStorage.getItem('token');

        // Set authorization header with Bearer token
        // axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

        // Make API request to create user
        const response = await axios.post('http://127.0.0.1:8000/api/user', {
          name: this.name,
          email: this.email,
          phone: this.phone,
          password: this.password,
          type_id: this.type_id
        });

        // Handle success
        alert('User created successfully');
        this.$router.push('/user');
        window.location.reload(); // Reload the page
      } catch (error) {
        // Handle error
        console.error('Error creating user:', error);
      }
    },
    cancel() {
      this.$emit('close');
    }
  }
};
</script>

<style scoped>
/* Your scoped styles here */
</style>
