<template>
    <div class="container w-[430px] border border-[#8C8C8C] rounded-[10px] p-[15px] flex flex-col">
        <div class="w-[400px] h-[40px] text-[#8C8C8C] border border-[#8C8C8C] rounded-[10px] flex items-center px-[20px]">
            <p>Cashier:</p>
            <p>Chab Sreylen</p>
        </div>
        <div class=" h-[1px] w-[400px] bg-[#8C8C8C] mt-4"></div>
        <div class="flex mt-[10px] justify-between"> 
            <div class="flex">
                <p class="text-[16px] text-black font-[700px]">Product Add</p>
                <div class="w-[20px] h-[20px] flex items-center justify-center bg-[#FF5E01] rounded-[50px] text-[14px] ml-[10px] text-white">5</div>
            </div>
            <div class="flex">
                <p class="text-[16px] text-[#FF5E01]">Clear All</p>
            </div>
        </div>
        <div class="w-[400px] h-[482px] bg-[#F1F2F2] p-[20px] mt-8 overflow-y-auto">
            <div class="w-[360px] h-[100px] bg-white flex py-[10px] px-[10px] flex items-center justify-cenetr ">
                <img class="w-[7opx] h-[80px]" src="../../assets/images/python.jpg" alt="">
                <div class="flex flex-col ml-8 justify-items-start">
                    <div class="w-[50px] h-[15px] bg-[#FF5E01] text-white flex items-center justify-center rounded-md">
                        <p class="text-[12px]">NOO1</p>
                    </div>
                    <div class="grid grid-row-2 gap-8 w-[100px] mt-2 ">
                        <p class="text-[14px] font-bold text-black text-left">
                        Conan the boy in the future
                        </p>
                    </div>
                    <p class="text-[14px] font-bold text-[#009C22] text-left">
                        10 $
                    </p>
                </div>
                <div class=" grid grid-cols-3 gap-1 p-1 w-[70px] h-[25px] ml-4 rounded-[30px] border border-[#8C8C8C] flex items-center justify-center">
                    <div class="w-[15px] h-[15px] border rounded-[30px] border-black flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-[15px] h-[15px] text-black" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M5 11V13H19V11H5Z"></path></svg>
                    </div>
                    <p class="text-[10px] font-bold text-black ">
                        10 
                    </p>
                    <div class="w-[15px] h-[15px] border rounded-[30px] border-black flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-[15px] h-[15px] text-black" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z"></path></svg>
                    </div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg"  fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FF5E01" class="size-6 ml-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
            </div>  
        </div>
        <div class=" h-[1px] w-[400px] bg-[#8C8C8C] mt-4"></div>
        <div class="w-[400px] h-[40px] bg-[#FE5E02] mt-4 text-[#8C8C8C] rounded-[10px] flex items-center justify-center px-[20px]">
            <p class="text-[17px] text-white font-bold">Grand Total: $</p>
            <p class="text-[17px] text-white font-bold ml-4">40.00 </p>
        </div>
        <div class=" h-[1px] w-[400px] bg-[#8C8C8C] mt-4"></div>
       <div class="flex justify-end">
            <div class="w-[100px] h-[40px] bg-[#FE5E02] flex mt-4 text-[#8C8C8C] rounded-[10px] flex items-center justify-center px-[20px]">
                <p class="text-[17px] text-white font-bold">Order</p>
            </div>
       </div>
    </div>
</template>

<script>
export default {
    name:"Cart",
}
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Quicksand:wght@300;400&display=swap");

@import url("https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Lato:ital,wght@0,300;0,400;1,300&family=Quicksand:wght@300;400&display=swap");

.container{
    font-family: Quicksand;
}


</style>