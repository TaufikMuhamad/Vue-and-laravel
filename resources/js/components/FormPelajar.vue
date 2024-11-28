<template>
    <div class="flex h-screen">
      <!-- Sidebar -->
      <Sidebar :isSidebarOpen="isSidebarOpen" @toggleSidebar="toggleSidebar" />

      <!-- Main Content -->
      <div class="flex-1 p-8">
        <h1 class="text-2xl font-bold mb-4">Tambah Pelajar</h1>
        <form @submit.prevent="submitForm">
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Full Name</label>
            <input v-model="form.full_name" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded" required />
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input v-model="form.email" type="email" class="mt-1 block w-full p-2 border border-gray-300 rounded" required />
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Degree</label>
            <input v-model="form.degree" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded" required />
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Hobi</label>
            <select v-model="form.hobi_id" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
              <option v-for="hobi in hobis" :key="hobi.id" :value="hobi.id">{{ hobi.name }}</option>
            </select>
          </div>
          <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded hover:bg-blue-700">Submit</button>
        </form>
      </div>
    </div>
  </template>

  <script>
  import Sidebar from "@/components/Sidebar.vue";
  import axios from "axios";
  import { ref, onMounted } from "vue";

  export default {
    components: {
      Sidebar,
    },
    data() {
      return {
        isSidebarOpen: true,
        form: {
          full_name: "",
          email: "",
          degree: "",
          hobi_id: null,
        },
        hobis: [],
      };
    },
    methods: {
      toggleSidebar() {
        this.isSidebarOpen = !this.isSidebarOpen;
      },
      submitForm() {
        axios
          .post("http://127.0.0.1:8000/api/siswa", this.form)
          .then((response) => {
            console.log("Siswa berhasil ditambahkan:", response.data);
            alert("Data berhasil ditambahkan!");
          })
          .catch((error) => {
            console.error("Error:", error);
            alert("Terjadi kesalahan saat menambahkan data!");
          });
      },
    },
    mounted() {
      axios.get("http://127.0.0.1:8000/api/hobi").then((response) => {
        this.hobis = response.data;
      });
    },
  };
  </script>

  <style scoped>


  </style>
