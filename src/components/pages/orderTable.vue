<template>
    <div class="w-full h-[60px] border-b flex items-center text-black px-5 justify-around" @click="togglePopup">
        <p class="text-center w-1/5">{{ receipt_number }}</p>
        <p class="text-center w-1/5">{{ id }}</p>
        <p class="text-center w-1/5">{{ name }}</p>
        <p class="text-center w-1/5">{{ total }}</p>
        <p class="text-center w-1/5">{{ create_at }}</p>
    </div>
    <div v-if="showPopup" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50" @click.self="togglePopup">
        <div class="bg-white p-6 rounded shadow-lg w-1/2">
            <h2 class="text-xl font-semibold mb-4">Details</h2>
            <ul class="list-disc pl-5">
                <div v-for="(group, index) in groupedDetails" :key="index" class="border-b mb-2 pb-2">
                    <p>Product: {{ group.name }}</p>
                    <p>Quantity: {{ group.quantity }}</p>
                    <p>Unit Price: {{ group.unitPrice }}</p>
                    <p>Discount: {{ group.discountPercentage }}%</p>
                </div>
            </ul>
            <button @click="togglePopup" class="mt-4 bg-orange-500 text-white px-4 py-2 rounded">Close</button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "orderTable",
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
        receipt_number: {
            type: String,
            required: true
        },
        name: {
            type: String,
            required: false,
        },
        create_at: {
            type: String,
            required: false
        },
        total: {
            type: String,
            required: false,
        },
        details: {
            type: Array,
            required: false,
            default: () => [],
        }
    },
    computed: {
        groupedDetails() {
            const grouped = this.details.reduce((acc, detail) => {
                const existing = acc.find(item => item.name === detail.product.name);
                if (existing) {
                    existing.quantity += detail.quantity;
                    // Ensure unit price and discount percentage are consistent (or handle as needed)
                } else {
                    acc.push({
                        name: detail.product.name,
                        quantity: detail.quantity,
                        unitPrice: detail.unit_price,
                        discountPercentage: detail.discount
                    });
                }
                return acc;
            }, []);
            return grouped;
        }
    },
    methods: {
        togglePopup() {
            this.showPopup = !this.showPopup;
            console.log('Toggle Popup:', this.showPopup);
        },
        async deleteProduct() {
            try {
                const response = await axios.get(`http://127.0.0.1:8000/api/products/delete/${this.id}`);
                console.log('Product deleted:', response.data.message);
                this.$emit('productDeleted'); // Emit an event to notify the parent component to update the list
                this.showPopup = false; // Close the popup after deletion
            } catch (error) {
                console.error('Error deleting product:', error);
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
        this.fetchProductsType();
    },
};
</script>

<style scoped>
/* No additional styles needed, as Tailwind CSS is used */
</style>
