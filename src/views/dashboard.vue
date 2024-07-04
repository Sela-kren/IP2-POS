<template>
    <div class="w-screen h-full flex">
      <SideBar class="w-1/5"></SideBar>
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
            <p class="text-16 font-bold">Dashboard</p>
          </div>
          <div class="flex w-fit h-fit bg-orange-500">
            <div class="w-fit h-[898px] bg-white mt-4 flex flex-col p-10 gap-5">
                <div class="flex gap-4 justify-center items-center w-full">
                <div v-for="(stat, index) in stats" :key="index" class="w-96 h-[150px] bg-[#FF5E01] rounded-lg p-5 flex items-center gap-5 flex-col">
                    <h1 class="text-4xl text-white">{{ stat.title }}</h1>
                    <h1 class="text-4xl text-white">{{ stat.value }}</h1>
                </div>
                </div>
                <div class=" w-fit mt-8 text-white">
                <h2 class="text-2xl font-bold mb-4">Most Ordered Products</h2>
                <table class="min-w-full bg-orange-500 rounded-lg">
                    <thead>
                    <tr>
                        <th class="py-2">ID</th>
                        <th class="py-2">Image</th>
                        <th class="py-2">Name</th>
                        <th class="py-2">Code</th>
                        <th class="py-2">Price</th>
                        <th class="py-2">Total_ordered</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="text-black bg-orange-200" v-for="(product, index) in mostOrderedProducts" :key="index">
                        <td class="py-2 px-4">{{ product.id }}</td>
                        <td class="py-2 px-4">{{ product.image }}</td>
                        <td class="py-2 px-4">{{ product.name }}</td>
                        <td class="py-2 px-4">{{ product.code }}</td>
                        <td class="py-2 px-4">{{ product.unit_price }}</td>
                        <td class="py-2 px-4">{{ product.total_ordered }}</td>
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>
            <div class="w-full h-[898px] bg-gray-200 mt-4 flex flex-col p-10 gap-5 items-center">
                <div class=" w-full mt-8 bg-orange-500 text-white rounded-lg">
                    <h2 class="text-2xl font-bold mb-4">Last ordered product</h2>
                    <table class="w-full bg-orange-200 text-black rounded-b-lg">
                        <thead>
                        <tr>
                            <th class="py-2">Name</th>
                            <th class="py-2">Price</th>
                            <th class="py-2">quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(item, index) in lastTenOrderProducts" :key="index">
                            <td class="py-2 px-4">{{ item.product_name }}</td>
                            <td class="py-2 px-4">{{ item.unit_price}}</td>
                            <td class="py-2 px-4">{{ item.quantity }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="flex flex-col w-full justify-center items-center mt-10">
                    <p> Most ordered Category</p>
                    <div class="flex justify-center h-fit w-full">
                        <canvas ref="pieChart" width="280"  height="280"></canvas>
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
  import axios from 'axios';
  import Chart from 'chart.js/auto';
  
  export default {
    name: "dashboard",
    components: {
      SideBar,
      Header,
    },
    data() {
      return {
        stats: [],
        mostOrderedProducts: [],
        lastTenOrderProducts: [],
        mostOrderedCategory: []
      };
    },
    created() {
      this.fetchData();
    },
    methods: {
      async fetchData() {
        try {
          const response = await axios.get('http://127.0.0.1:8000/api/dashboard');
          const data = response.data;
          this.stats = [
            { title: 'Total Sales ($) :', value: data.total_sale },
            { title: 'Total Orders :', value: data.total_orders }
          ];
          this.mostOrderedProducts = data.most_ordered_products;
          this.lastTenOrderProducts = data.lastTenOrderProducts;
          this.mostOrderedCategory = data.mostOrderedCategory;
          this.renderPieChart(data.mostOrderedCategory);
        } catch (error) {
          console.error('Error fetching data:', error);
        }
      },
      renderPieChart(mostOrderedCategory) {
      const ctx = this.$refs.pieChart.getContext('2d');
      const transformedData = mostOrderedCategory.map(item => ({
        label: item.product_type_name,
        value: item.count,
      }));
      this.pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: transformedData.map(data => data.label),
          datasets: [{
            data: transformedData.map(data => data.value),
            backgroundColor: [
              '#FF5733', // Orange Red
              '#FFD700', // Gold
              '#357EC7', // Cornflower Blue
              '#20B2AA', // Light Sea Green
              '#9932CC', // Dark Orchid
              '#FF6347', // Tomato
              '#00CED1', // Dark Turquoise
              '#FF8C00', // Dark Orange
              '#4682B4', // Steel Blue
              '#6A5ACD', // Slate Blue
            ],
            // Example colors
          }],
        },
        options: {
        responsive: true,
        maintainAspectRatio: false,
        layout: {
          padding: 0, // Adjust padding around the chart
        },
        plugins: {
          legend: {
            position: 'bottom', // Ensure legend is on the right side
          },
        },
      },
      });
    },
    }
  }
  </script>
  
  <style scoped>
  @import url("https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Quicksand:wght@300;400&display=swap");
  
  .container {
    font-family: Quicksand;
  }
  </style>
  