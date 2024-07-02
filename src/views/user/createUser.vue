<!-- src/views/user/CreateUser.vue -->

<template>
  <div>
    <h2 class="text-2xl font-bold mb-4">Create User</h2>
    <form @submit.prevent="createUser">
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name</label>
        <input v-model="name" type="text" id="name" class="p-2 border rounded w-full" required />
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
        <input v-model="email" type="email" id="email" class="p-2 border rounded w-full" required />
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">Phone</label>
        <input v-model="phone" type="text" id="phone" class="p-2 border rounded w-full" required />
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
        <input v-model="password" type="password" id="password" class="p-2 border rounded w-full" required />
      </div>
      <div class="flex justify-end space-x-4">
        <button type="button" @click="cancel" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</button>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: "CreateUser",
  data() {
    return {
      name: '',
      email: '',
      phone: '',
      password: ''
    };
  },
  methods: {
    async createUser() {
      try {
        await axios.post('http://127.0.0.1:8000/api/user', {
          name: this.name,
          email: this.email,
          phone: this.phone,
          password: this.password
        });
        this.$emit('close');
        this.$router.push({ name: 'user' });
      } catch (error) {
        console.error('Error creating user:', error);
      }
    },
    cancel() {
      this.$emit('close');
    }
  }
}
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Quicksand:wght@300;400&display=swap");

.container {
  font-family: Quicksand;
}
</style>
