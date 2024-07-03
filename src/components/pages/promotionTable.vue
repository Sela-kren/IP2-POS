<template>
    <div class="w-full h-[60px] border-b flex items-center text-black px-5 justify-around">
              <p class=" text-center w-1/5">{{ name }}</p>
              <p class=" text-center w-1/5">{{ promotion }}</p>
              <p class=" text-center w-1/5">{{ startDate }}</p>
              <p class=" text-center w-1/5">{{ endDate }}</p>
              <p class=" text-center w-1/5">{{delete_at}}</p>
          </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "promotionTable",
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
        name: {
            type: String,
            required: true
        },
        promotion: {
            type: String,
            required: false,
            default: 'N/A'
        },
        startDate: {
            type: String,
            required: false
        },
        endDate: {
            type: String,
            required: false
        },
        delete_at: {
            type: String,
            required: false,
            default: 'N/A',
        },
    },
    methods: {
        togglePopup(event) {
            this.showPopup = !this.showPopup;
            console.log('Toggle Popup:', this.showPopup);
            event.stopPropagation(); // Prevent click event from bubbling up to the document
        },
        async deleteProduct() {
            try {
                const response = await axios.get(`http://127.0.0.1:8000/api/products/delete/${this.id}`);
                console.log('Product deleted:', response.data.message);
                // Optionally, emit an event to notify the parent component to update the product list
                // Example:
                this.$emit('productDeleted'); // Emit an event to notify the parent component to update the list
                this.showPopup = false; // Close the popup after deletion
            } catch (error) {
                console.error('Error deleting product:', error);
            }
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
                const response = await axios.get(`http://127.0.0.1:8000/api/product-types/${this.type_id}`);
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
