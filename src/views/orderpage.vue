<template>
    <div class="w-screen h-screen bg-red-200 flex">
        <SideBar class="w-1/5"></SideBar>
        <div class="w-full h-fit bg-blue-200">
            <Header></Header>
            <div class="h-[calc(100vh-50px)] bg-[#D9D9D9] py-8 px-8"> 
                <div class="w-[1149px] h-[898px] bg-white rounded-2"></div>
            </div> 
        </div> 
    </div>
</template>


<script>
import SideBar from '@/components/pages/SideBar.vue';
import Header from '@/components/pages/Header.vue';
export default {
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