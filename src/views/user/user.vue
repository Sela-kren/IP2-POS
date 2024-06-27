<!-- <template>
    <div class="w-screen h-full flex">
        <SideBar></SideBar>
        <div class="w-full">
            <Header></Header>
            <div class="flex-1  bg-[#D9D9D9] px-8 flex-col pt-4"> 
                <div class="flex items-center space-x-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[30px] h-[30px] text-black text-bold" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
                        <path strokeLinecap="round" strokeLinejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[20px] h-[20px] text-bold text-black " fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                    <p class="text-16 font-bold">User</p>
                </div>
                <div class="w-w-6/12 h-[898px] bg-white mt-4 flex  flex-col">
                   <div class="flex justify-between px-4 py-4">
                        <div class="flex font-bold">
                            
                            <p class="text-[16px]">{{totalUsers}}</p>
                            <p class="text-[16px] ml-4">Users</p>
                        </div>
                        <router-link :to="{ name: 'createUser' }">
                          <div class="flex w-[150px] h-[45px] text-[#D9D9D9] border-2 border-[#D9D9D9] rounded-md items-center justify-center space-x-4 cursor-pointer">
                            <div class="w-[20px] h-[20px] border rounded-[30px] border-[#948984] flex items-center">
                              <svg xmlns="http://www.w3.org/2000/svg" class="w-[20px] h-[20px] text-black" viewBox="0 0 24 24" fill="#948984">
                                <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z"></path>
                              </svg>
                            </div>
                            <p class="text-[20px] text-[#948984]">Create</p>
                          </div>
                        </router-link>
                   </div>
                   <div class="grid grid-row-8">
                    <div class="flex justify-between items-center mb-4">
                        <input v-model="searchKey" @input="fetchData" type="text" placeholder="Search by name or phone" class="p-2 border rounded">
                        <select v-model="limit" @change="fetchData" class="p-2 border rounded">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                        <div class="w-full h-[60px] bg-[#0F172A] grid grid-cols-5 items-center justify-evenly text-white p-5">
                            <p>ID</p>
                            <p>Cashier</p>
                            <p>Role</p>
                            <p>Contact</p>
                            <p>Date</p>
                        </div>
                        <div v-for="user in users.data" :key="user.id" class="w-full h-[60px] p-5 border border-b-[#D9D9D9]  grid grid-cols-5 items-center justify-evenly text-black font-bold">
                            <p>{{ user.id }}</p>
                            <p>{{ user.name }}</p>
                            <p>{{ user.type.name }}</p>
                            <p>{{ user.phone }}</p>
                            <div class="flex items-center space-x-2">
                                <p>{{ user.created_at }}</p>
                                <p>{{ user.is_active ? 'Yes' : 'No' }}</p>
                            </div>
                        </div>
                   </div>
                    

                    
                </div>
            </div> 
        </div> 
    </div>
</template>

<script>

import SideBar from '../../components/pages/SideBar.vue';
import Header from '../../components/pages/Header.vue';
import axios from 'axios';

import { RouterLink, RouterView } from 'vue-router'

export default {
    name:"user",
    components:{
        SideBar,
        Header,
        
    },
    data() {
    return {
        users: {},
        totalUsers: 0,
        searchKey: '',
        limit: 10,
        page: 1,
        sort: 'desc'
    };
    },
    created() {
    this.fetchData();
    },
    methods: {
    async fetchData() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/user', {
          params: {
            key: this.searchKey,
            limit: this.limit,
            page: this.page,
            sort: this.sort
          }
        });
        this.users = response.data.data;
        this.totalUsers = response.data.total_users;
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    },
    nextPage() {
      if (this.users.next_page_url) {
        this.page++;
        this.fetchData();
      }
    },
    prevPage() {
      if (this.users.prev_page_url) {
        this.page--;
        this.fetchData();
      }
    }
  }
}





</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Quicksand:wght@300;400&display=swap");

@import url("https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Lato:ital,wght@0,300;0,400;1,300&family=Quicksand:wght@300;400&display=swap");

.container{
    font-family: Quicksand;
}


</style> -->



<template>
  <div class="w-screen h-full flex">
    <SideBar></SideBar>
    <div class="w-full">
      <Header></Header>
      <div class="flex-1 bg-[#D9D9D9] px-8 flex-col pt-4">
        <div class="flex items-center space-x-2.5">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-[30px] h-[30px] text-black text-bold" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
            <path strokeLinecap="round" strokeLinejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="w-[20px] h-[20px] text-bold text-black " fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
          </svg>
          <p class="text-16 font-bold">User</p>
        </div>
        <div class="w-w-6/12 h-[898px] bg-white mt-4 flex flex-col">
          <div class="flex justify-between px-4 py-4">
            <div class="flex font-bold">
              <p class="text-[16px]">{{totalUsers}}</p>
              <p class="text-[16px] ml-4">Users</p>
            </div>
            <div @click="openModal" class="text-[20px] text-[#948984] cursor-pointer">
              <div class="flex w-[150px] h-[45px] text-[#D9D9D9] border-2 border-[#D9D9D9] rounded-md items-center justify-center space-x-4">
                <div class="w-[20px] h-[20px] border rounded-[30px] border-[#948984] flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-[20px] h-[20px] text-black" viewBox="0 0 24 24" fill="#948984">
                    <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z"></path>
                  </svg>
                </div>
                <p class="text-[20px] text-[#948984]">Create</p>
              </div>
            </div>
          </div>
          <div class="grid grid-row-8">
            <div class="flex justify-between items-center mb-4">
              <input v-model="searchKey" @input="fetchData" type="text" placeholder="Search by name or phone" class="p-2 border rounded">
              <select v-model="limit" @change="fetchData" class="p-2 border rounded">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
              </select>
            </div>
            <div class="w-full h-[60px] bg-[#0F172A] grid grid-cols-5 items-center justify-evenly text-white p-5">
              <p>ID</p>
              <p>Cashier</p>
              <p>Role</p>
              <p>Contact</p>
              <p>Date</p>
            </div>
            <div v-for="user in users.data" :key="user.id" class="w-full h-[60px] p-5 border border-b-[#D9D9D9] grid grid-cols-5 items-center justify-evenly text-black font-bold">
              <p>{{ user.id }}</p>
              <p>{{ user.name }}</p>
              <p>{{ user.type.name }}</p>
              <p>{{ user.phone }}</p>
              <div class="flex items-center space-x-2">
                <p>{{ user.created_at }}</p>
                <p>{{ user.is_active ? 'Yes' : 'No' }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <Modal :isOpen="isModalOpen" @close="closeModal">
        <CreateUser @close="closeModal"></CreateUser>
      </Modal>
    </div>
  </div>
</template>

<script>
import SideBar from '../../components/pages/SideBar.vue';
import Header from '../../components/pages/Header.vue';
import axios from 'axios';
import Modal from '../../components/Modal.vue';
import CreateUser from '../../views/user/createUser.vue';

export default {
  name: "user",
  components: {
    SideBar,
    Header,
    Modal,
    CreateUser,
  },
  data() {
    return {
      users: {},
      totalUsers: 0,
      searchKey: '',
      limit: 10,
      page: 1,
      sort: 'desc',
      isModalOpen: false
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    async fetchData() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/user', {
          params: {
            key: this.searchKey,
            limit: this.limit,
            page: this.page,
            sort: this.sort
          }
        });
        this.users = response.data.data;
        this.totalUsers = response.data.total_users;
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    },
    nextPage() {
      if (this.users.next_page_url) {
        this.page++;
        this.fetchData();
      }
    },
    prevPage() {
      if (this.users.prev_page_url) {
        this.page--;
        this.fetchData();
      }
    },
    openModal() {
      this.isModalOpen = true;
    },
    closeModal() {
      this.isModalOpen = false;
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
