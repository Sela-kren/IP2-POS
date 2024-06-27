<template>
    <tr class="h-[60px] flex items-center text-sm mx-2 border-b border-b-slate-200">
        <th class="w-3/12">{{ category }}</th>
        <th class="w-3/12 text-start">{{ type_id }} </th>
        <th class="w-3/12 text-start">{{ name }}</th>
        <th class="w-1/12 text-start pl-2">{{ unitPrice }} $</th>
        <th 
            :class="{
                'w-2/12 bg-orange-500 text-white rounded-full leading-loose': stock <= 10,
                'w-2/12': stock > 10
            }"
        >{{ stock }}</th>
        <th 
            :class="{
                'w-2/12 bg-green-500 text-white rounded-full leading-loose ml-3': promotion >= 15,
                'w-2/12': promotion < 15
            }"
        >{{ promotion }} %</th>
        <th class="w-2/6">{{ endDate }}</th>
        <th class="w-1/12 flex justify-center relative">
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
                    <div class="flex items-center justify-between px-1">
                        <img src="../../assets/images/Group 107.svg" class="w-1/3 h-6" alt="">
                        <p class="w-2/3 text-sm text-red-500 text-start">Delete</p>
                    </div>
                </div>
            </div>
        </th>
    </tr>
</template>

<script>
import axios from 'axios';

export default {
    name: "InventoryTable",
    data() {
        return {
            showPopup: false,
            type: [],
        };
    },
    props: {
        id: {
            type: String,
            required: true
        },
        type_id: {
            type: String,
            required: true
        },
        code: {
            type: String,
            required: true
        },
        name: {
            type: String,
            required: true
        },
        image: {
            type: String,
            required: true,
            default: '../../assets/images/default.jpg'
        },
        unitPrice: {
            type: Number,
            required: false
        },
        stock: {
            type: Number,
            required: false,
            default: 0
        },
        category: {
            type: String,
            required: false
        },
        promotion: {
            type: String,
            required: false
        },
        startDate: {
            type: String,
            required: false
        },
        endDate: {
            type: String,
            required: false
        },
    },
    methods: {
        togglePopup(event) {
            this.showPopup = !this.showPopup;
            console.log('Toggle Popup:', this.showPopup);
            event.stopPropagation(); // Prevent click event from bubbling up to the document
        },
        handleClickOutside(event) {
            const popup = this.$refs.popup;
            const popupImage = this.$refs.popupImage;

            if (popup && !popup.contains(event.target) && !popupImage.contains(event.target)) {
                this.showPopup = false;
            }
        },
        async fetchProductsType() {
            try {
                const response = await axios.get('http://127.0.0.1:8000/api/product-types/' + this.type_id);
                this.type = response.data;
                console.log(this.type);
            } catch (error) {
                console.error('Error fetching products:', error);
            }
        }
    },
    mounted() {
        document.addEventListener("click", this.handleClickOutside);
        this.fetchProductsType();
    },
    beforeDestroy() {
        document.removeEventListener("click", this.handleClickOutside);
    },
};
</script>
