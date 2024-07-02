<template>
    <div class="grid grid-row-4">
        <!-- <tr class="h-[60px] flex justify-start items-center text-sm mx-2 border-b border-b-slate-200">
            <th class="text-start">{{ id }}</th>
            <th class="text-start">{{ name }}</th>
            <th class="text-start">{{ type_name }}</th>
            <th class="text-start">{{ phone }}</th>
            <th class="text-start">{{ date }}</th>
            <th class="flex justify-center relative">
                <img
                    class="w-4 h-4 cursor-pointer"
                    src="../../assets/images/more-svgrepo-com (1).svg"
                    alt=""
                    @click="togglePopup"
                    ref="popupImage"
                />
                <div v-if="showPopup" class="w-[160px] h-[88px] absolute top-6 right-4 bg-white border py-2 px-3 shadow-lg z-10 rounded-md" ref="popup">
                    <!-- Your pop-up content goes here -->
                    <!-- <div class="w-full h-full flex flex-col justify-evenly gap-2.5">
                        <router-link :to="'/manage/update/' + id" class="flex items-center justify-between px-1">
                            <img src="../../assets/images/Group 104.svg" class="w-1/3 h-6" alt="">
                            <p class="w-2/3 text-sm text-start">Edit User</p>
                        </router-link>
                        <div class="flex items-center justify-between px-1">
                            <img src="../../assets/images/Group 107.svg" class="w-1/3 h-6" alt="">
                            <p class="w-2/3 text-sm text-red-500 text-start">Delete</p>
                        </div>
                    </div>
                </div>
            </th>
         </tr>    -->
         <div class="w-full h-[60px] pl-20 border border-b-[#D9D9D9] grid grid-cols-5 items-center justify-evenly text-black font-bold">
            <p>{{ name }}</p>
            <p>{{ type_name }}</p>
            <p>{{ phone }}</p>
            <p>{{ date }}</p>
            <div class="w-1/12 flex justify-center relative">
                <img
                class="w-4 h-4 cursor-pointer"
                src="../../assets/images/more-svgrepo-com (1).svg"
                alt=""
                @click="togglePopup"
                ref="popupImage"
            />
            <div v-if="showPopup" class="w-[160px] h-[88px] absolute top-6 right-4 bg-white border py-2 px-3 shadow-lg z-10 rounded-md" ref="popup">
                <!-- Your pop-up content goes here -->
                <div class="w-full h-full flex flex-col justify-evenly gap-2.5">
                    <router-link :to="'/manage/update/' + id" class="flex items-center justify-between px-1">
                        <img src="../../assets/images/Group 104.svg" class="w-1/3 h-6" alt="">
                        <p class="w-2/3 text-sm text-start">Edit Product</p>
                    </router-link>
                    <div class="flex items-center justify-between px-1" @click="deleteProduct">
                        <img src="../../assets/images/Group 107.svg" class="w-1/3 h-6" alt="">
                        <p class="w-2/3 text-sm text-red-500 text-start cursor-pointer">Delete</p>
                    </div>
                </div>
            </div>
            </div>
         </div>
         
    </div>
    
</template>

<script>
import axios from 'axios';

export default {
    name: "User",
    props: {
        id: {
            type: String,
            required: true
        },
        name: {
            type: String,
            required: true
        },
        type_name: {
            type: String,
            required: true
        },
        phone: {
            type: String,
            required: true
        },
        date: {
            type: String,
            required: false
        }
    },
    data() {
        return {
            showPopup: false
        };
    },
    methods: {
        togglePopup() {
            this.showPopup = !this.showPopup;
        },
        async deleteUser() {
            try {
                const response = await axios.delete(`http://127.0.0.1:8000/api/user/${this.id}`);
                console.log('User deleted:', response.data.message);
                // Emit an event to notify the parent component to update the User list
                this.$emit('user-deleted');
                this.showPopup = false; // Close the popup after deletion
            } catch (error) {
                console.error('Error deleting User:', error);
            }
        },
        handleClickOutside(event) {
            const popup = this.$refs.popup;
            const popupImage = this.$refs.popupImage;

            if (popup && !popup.contains(event.target) && !popupImage.contains(event.target)) {
                this.showPopup = false;
            }
        }
    },
    mounted() {
        document.addEventListener("click", this.handleClickOutside);
    },
    beforeDestroy() {
        document.removeEventListener("click", this.handleClickOutside);
    }
};
</script>

<style scoped>
/* Your scoped styles here */
</style>
