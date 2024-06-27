<template>
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
                            <p class="text-[16px]">7</p>
                            <p class="text-[16px] ml-4">users</p>
                        </div>
                        <div class="flex w-[150px] h-[45px] text-[#D9D9D9] border-2 border-[#D9D9D9] rounded-md items-center justify-center space-x-4 cursor-pointer">
                            <div class="w-[20px] h-[20px] border rounded-[30px] border-[#948984] flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-[20px] h-[20px] text-black" viewBox="0 0 24 24" fill="#948984">
                                <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z"></path></svg>
                            </div>
                            <p class="text-[20px] text-[#948984]">Create</p>
                        </div>    
                   </div>
                   <div class="grid grid-row-8">
                        <div class="w-full h-[60px] bg-[#0F172A] grid grid-cols-4 items-center justify-center text-white">
                            <p>ID</p>
                            <p>Cashier</p>
                            <p>Contact</p>
                            <p>Date</p>
                        </div>
                        <div class="w-full h-[60px] border border-b-[#D9D9D9]  grid grid-cols-4 items-center justify-center text-black font-bold">
                            <p>1</p>
                            <p>CHAB Sreylen</p>
                            <p>091234567</p>
                            <div class="flex items-center justify-center space-x-2">
                                <p>2024-02-04</p>
                                <p>12:00</p>
                            </div>
                        </div>
                   </div>
                    

                    
                </div>
            </div> 
        </div> 
    </div>
</template>

<script>

import SideBar from '../components/pages/SideBar.vue';
import Header from '../components/pages/Header.vue';

// import { RouterLink, RouterView } from 'vue-router'

export default {
    name:"user",
    components:{
        SideBar,
        Header,
        
    }

}



</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Quicksand:wght@300;400&display=swap");

@import url("https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Lato:ital,wght@0,300;0,400;1,300&family=Quicksand:wght@300;400&display=swap");

.container{
    font-family: Quicksand;
}


</style>