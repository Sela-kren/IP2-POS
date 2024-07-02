<template>
    <div class="grid grid-row-5">
        <div class="w-full h-[60px] pl-20 border border-b-[#D9D9D9] grid grid-cols-5 items-center justify-evenly text-black font-bold">
            <!-- Display user information -->
            <p>{{ name }}</p>
            <p>{{ type_name }}</p>
            <p>{{ phone }}</p>
            <p>{{ date }}</p>
            
            <!-- More options button -->
            <div class="w-1/12 flex justify-center relative">
                <img
                    class="w-4 h-4 cursor-pointer"
                    src="../../assets/images/more-svgrepo-com (1).svg"
                    alt=""
                    @click="togglePopup"
                    ref="popupImage"
                />
                <!-- Popup content -->
                <div v-if="showPopup" class="w-[160px] h-[88px] absolute top-6 right-4 bg-white border py-2 px-3 shadow-lg z-10 rounded-md" ref="popup">
                    <div class="w-full h-full flex flex-col justify-evenly gap-2.5">
                        <!-- Open modal to edit user -->
                        <div @click="openModal" class="flex justify-center items-center text-[20px] text-[#948984] cursor-pointer">
                            <img src="../../assets/images/Group 104.svg" class="w-1/3 h-6" alt="">
                            <p class="w-2/3 text-sm text-start">Edit User</p>
                        </div>
                        <!-- Delete user -->
                        <div class="flex items-center justify-between px-1" @click="deleteUser">
                            <img src="../../assets/images/Group 107.svg" class="w-1/3 h-6" alt="">
                            <p class="w-2/3 text-sm text-red-500 text-start cursor-pointer">Delete</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for updating user -->
        <Modal :isOpen="isModalOpen" @close="closeModal">
            <UpdateUser @close="closeModal" :id="user.id" :name="name" :type_name="type_name" :phone="phone" :date="date" @user-updated="handleUserUpdated" />
        </Modal>
    </div>
</template>

<script>
import axios from 'axios';
import Modal from '../../components/Modal.vue';
import UpdateUser from '@/views/user/updateUser.vue';

export default {
    name: "User",
    components: {
        Modal,
        UpdateUser,
    },
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
            showPopup: false,
            isModalOpen: false
        };
    },
    methods: {
        togglePopup() {
            this.showPopup = !this.showPopup;
        },
        openModal() {
            this.isModalOpen = true;
            this.showPopup = false; // Close the popup after opening modal
        },
        closeModal() {
            this.isModalOpen = false;
        },
        async deleteUser() {
            try {
                console.log('Deleting user with ID:', this.id);
                const response = await axios.delete(`http://127.0.0.1:8000/api/user/${this.id}`);
                console.log('Response:', response.data);
                // ... rest of your code
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
