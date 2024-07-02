<template>
    <div class="w-screen h-full flex">
      <SideBar></SideBar>
      <div class="w-full">
        <Header></Header>
        <div class="flex-1 bg-[#D9D9D9] px-8 flex-col pt-4">
          <div class="flex items-center space-x-2.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-[30px] h-[30px] text-black text-bold" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-[20px] h-[20px] text-bold text-black" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
            <p class="text-16 font-bold">User</p>
          </div>
          <div class="w-full mt-4">
            <div class="flex justify-between px-4 py-4">
              <div class="flex items-center font-bold">
                <p class="text-[16px]">{{ totalUsers }}</p>
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
            <table class="w-full">
              <thead>
                <tr class="bg-[#0F172A] text-white">
                  <th class="w-1/6">ID</th>
                  <th class="w-2/6 text-start">Name</th>
                  <th class="w-1/6 text-start">Type</th>
                  <th class="w-1/6 text-start">Phone</th>
                  <th class="w-1/6">Created At</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in users.data" :key="user.id" class="h-[60px] flex justify-evenly items-center border-b border-b-slate-200">
                  <td>{{ user.id }}</td>
                  <td>{{ user.name }}</td>
                  <td>{{ user.type_name }}</td>
                  <td>{{ user.phone }}</td>
                  <td>{{ user.created_at }}</td>
                  <td>
                    <img class="w-4 h-4 cursor-pointer" src="../../assets/images/more-svgrepo-com (1).svg" alt="" @click="togglePopup(user.id)" ref="popupImage">
                    <div v-if="showPopup === user.id" class="absolute top-6 right-4 bg-white border py-2 px-3 shadow-lg z-10 rounded-md">
                      <router-link :to="'/manage/update/' + user.id" class="flex items-center justify-between px-1">
                        <img src="../../assets/images/Group 104.svg" class="w-1/3 h-6" alt="">
                        <p class="w-2/3 text-sm text-start">Edit User</p>
                      </router-link>
                      <div class="flex items-center justify-between px-1">
                        <img src="../../assets/images/Group 107.svg" class="w-1/3 h-6" alt="">
                        <p class="w-2/3 text-sm text-red-500 text-start">Delete</p>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
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
    name: "UserPage",
    components: {
      SideBar,
      Header,
      Modal,
      CreateUser
    },
    data() {
      return {
        users: {},
        totalUsers: 0,
        searchKey: '',
        limit: 10,
        page: 1,
        sort: 'desc',
        isModalOpen: false,
        showPopup: null // Track which user's popup is shown
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
      },
      togglePopup(userId) {
        this.showPopup = this.showPopup === userId ? null : userId;
      }
    }
  };
  </script>
  
  <style scoped>
  @import url("https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Quicksand:wght@300;400&display=swap");
  
  .container {
    font-family: Quicksand;
  }
  </style>
  