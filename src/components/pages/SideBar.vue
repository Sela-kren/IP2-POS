<template>
  <!-- Side Bar -->
  <div class="w-full md:w-1/4 bg-[#0F172A] h-screen md:h-auto">
    <!-- header sidebar -->
    <div class="h-[80px] bg-[#0F172A] flex justify-start items-center px-4 md:px-0">
      <div class="flex items-center">
        <img src="../../assets/images/logo.png" class="w-[100px] h-[100px]" alt="Logo">
        <div class="flex flex-col ml-2">
          <p class="text-[#FF5E01] font-bold text-[17px]">BOOK CORNER</p>
        </div>
      </div>
    </div>
    <!-- menu  -->
    <div class="flex-1 bg-[#0F172A] py-[20px]">
      <div class="px-4 md:pr-[20px] flex flex-col space-y-[10px] text-white">
        <!-- Dashboard -->
        <router-link 
          to="/" 
          class="inline-flex items-center py-[15px] px-[30px] w-full text-xl font-medium rounded-r-[30px] hover:bg-[#FF5E01] hover:text-white"
          active-class="active-link">
          <svg aria-hidden="true" class="mr-2 w-[25px] h-[25px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M22 12.999V20C22 20.5523 21.5523 21 21 21H13V12.999H22ZM11 12.999V21H3C2.44772 21 2 20.5523 2 20V12.999H11ZM11 3V10.999H2V4C2 3.44772 2.44772 3 3 3H11ZM21 3C21.5523 3 22 3.44772 22 4V10.999H13V3H21Z"></path>
          </svg>
          Dashboard
        </router-link>
        <!-- Bookshift -->
        <router-link 
          to="/bookshift" 
          class="inline-flex items-center py-[15px] px-[30px] w-full text-xl font-medium rounded-r-[30px] hover:bg-[#FF5E01] hover:text-white"
          active-class="active-link">
          <svg aria-hidden="true" class="mr-2 w-[25px] h-[25px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M21 18H6C5.44772 18 5 18.4477 5 19C5 19.5523 5.44772 20 6 20H21V22H6C4.34315 22 3 20.6569 3 19V4C3 2.89543 3.89543 2 5 2H21V18ZM16 9V7H8V9H16Z"></path>
          </svg>
          Bookshift
        </router-link>
        <!-- Order -->
        <!-- <router-link 
          to="/order" 
          class="inline-flex items-center py-[15px] px-[30px] w-full text-xl font-medium rounded-r-[30px] hover:bg-[#FF5E01] hover:text-white"
          active-class="active-link">
          <svg aria-hidden="true" class="mr-2 w-[25px] h-[25px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M4.00488 16V4H2.00488V2H5.00488C5.55717 2 6.00488 2.44772 6.00488 3V15H18.4433L20.4433 7H8.00488V5H21.7241C22.2764 5 22.7241 5.44772 22.7241 6C22.7241 6.08176 22.7141 6.16322 22.6942 6.24254L20.1942 16.2425C20.083 16.6877 19.683 17 19.2241 17H5.00488C4.4526 17 4.00488 16.5523 4.00488 16ZM6.00488 23C4.90031 23 4.00488 22.1046 4.00488 21C4.00488 19.8954 4.90031 19 6.00488 19C7.10945 19 8.00488 19.8954 8.00488 21C8.00488 22.1046 7.10945 23 6.00488 23ZM18.0049 23C16.9003 23 16.0049 22.1046 16.0049 21C16.0049 19.8954 16.9003 19 18.0049 19C19.1095 19 20.0049 19.8954 20.0049 21C20.0049 22.1046 19.1095 23 18.0049 23Z"></path>
          </svg>
          Order
        </router-link> -->
        <!-- Customer -->
        <!-- <router-link 
          to="/customer" 
          class="inline-flex items-center py-[15px] px-[30px] w-full text-xl font-medium rounded-r-[30px] hover:bg-[#FF5E01] hover:text-white"
          active-class="active-link">
          <svg aria-hidden="true" class="mr-2 w-[25px] h-[25px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M2 22C2 17.5817 5.58172 14 10 14C14.4183 14 18 17.5817 18 22H2ZM10 13C6.685 13 4 10.315 4 7C4 3.685 6.685 1 10 1C13.315 1 16 3.685 16 7C16 10.315 13.315 13 10 13ZM17.3628 15.2332C20.4482 16.0217 22.7679 18.7235 22.9836 22H20C20 19.3902 19.0002 17.0139 17.3628 15.2332ZM15.3401 12.9569C16.9728 11.4922 18 9.36607 18 7C18 5.58266 17.6314 4.25141 16.9849 3.09687C19.2753 3.55397 21 5.57465 21 8C21 10.7625 18.7625 13 16 13C15.7763 13 15.556 12.9853 15.3401 12.9569Z"></path>
          </svg>
          Customer
        </router-link> -->
        <!-- User -->
        <router-link 
          to="/user" 
          class="inline-flex items-center py-[15px] px-[30px] w-full text-xl font-medium rounded-r-[30px] hover:bg-[#FF5E01] hover:text-white"
          active-class="active-link">
          <svg aria-hidden="true" class="mr-2 w-[25px] h-[25px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M4 22C4 17.5817 7.58172 14 12 14C16.4183 14 20 17.5817 20 22H4ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13Z"></path>
          </svg>
          User
        </router-link>  
        <!-- Inventory -->
        <router-link 
          to="/Manage" 
          class="inline-flex items-center py-[15px] px-[30px] w-full text-xl font-medium rounded-r-[30px] hover:bg-[#FF5E01] hover:text-white"
          active-class="active-link">
          <svg aria-hidden="true" class="mr-2 w-[25px] h-[25px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M22.8 11.575V22.8C22.8 23.4628 22.2628 24 21.6 24H2.4C1.73726 24 1.2 23.4628 1.2 22.8V11.575C0.453168 10.7288 0 9.61728 0 8.4V1.2C0 0.537264 0.537264 0 1.2 0H22.8C23.4628 0 24 0.537264 24 1.2V8.4C24 9.61728 23.5469 10.7288 22.8 11.575ZM20.4 13.0488C20.0165 13.1474 19.6144 13.2 19.2 13.2C17.7664 13.2 16.4795 12.5714 15.6 11.575C14.7205 12.5714 13.4336 13.2 12 13.2C10.5664 13.2 9.27953 12.5714 8.4 11.575C7.52047 12.5714 6.23363 13.2 4.8 13.2C4.38564 13.2 3.98354 13.1474 3.6 13.0488V21.6H20.4V13.0488ZM14.4 8.4C14.4 7.73726 14.9372 7.2 15.6 7.2C16.2628 7.2 16.8 7.73726 16.8 8.4C16.8 9.72552 17.8745 10.8 19.2 10.8C20.5255 10.8 21.6 9.72552 21.6 8.4V2.4H2.4V8.4C2.4 9.72552 3.47452 10.8 4.8 10.8C6.12548 10.8 7.2 9.72552 7.2 8.4C7.2 7.73726 7.73726 7.2 8.4 7.2C9.06274 7.2 9.6 7.73726 9.6 8.4C9.6 9.72552 10.6745 10.8 12 10.8C13.3255 10.8 14.4 9.72552 14.4 8.4Z" fill="white"/>
          </svg>
          Inventory
        </router-link>  
      </div>
    </div>
  </div>
</template>

<script>
import { RouterLink } from 'vue-router'

export default {
  name: "SideBar", 
  components: {
    RouterLink
  }
}
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Quicksand:wght@300;400&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Lato:ital,wght@0,300;0,400;1,300&family=Quicksand:wght@300;400&display=swap");

.container {
  font-family: Quicksand;
}

.active-link {
  background-color: #FF5E01;
  color: white;
}
</style>
