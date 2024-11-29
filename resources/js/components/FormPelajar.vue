<template>
    <div class="flex h-screen">
      <!-- Sidebar -->
      <Sidebar :isSidebarOpen="isSidebarOpen" @toggleSidebar="toggleSidebar" />

      <!-- Konten Halaman -->
      <div class="flex-1 p-8">
        <h1 class="text-2xl font-bold mb-6">Tambah Pelajar</h1>

        <!-- Form Tambah Pelajar -->
        <form @submit.prevent="submitForm">
          <!-- Nama Lengkap -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Full Name</label>
            <input v-model="form.full_name" type="text" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" required />
          </div>

          <!-- Email -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input v-model="form.email" type="email" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" required />
          </div>

          <!-- Degree -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Degree</label>
            <input v-model="form.degree" type="text" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" required />
          </div>

          <!-- Hobi -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Hobi</label>
            <div class="space-y-2">
              <div v-for="hobi in hobis" :key="hobi.id" class="flex items-center">
                <input
                  type="checkbox"
                  :id="'hobi-' + hobi.id"
                  :value="hobi.id"
                  v-model="form.hobi_id"
                  class="mr-2"
                />
                <label :for="'hobi-' + hobi.id" class="text-sm text-gray-700">{{ hobi.name }}</label>
              </div>
            </div>
          </div>


          <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Tambah Hobi Baru</label>
            <div class="flex items-center space-x-2">

              <input
                v-model="newHobby"
                type="text"
                class="flex-1 p-3 border border-gray-300 rounded-md text-sm"
                placeholder="Masukkan hobi baru"
              />
              <button
                type="button"
                @click="addHobby"
                class="p-2 bg-green-600 text-white rounded-md text-sm hover:bg-green-700"
              >
                Tambah
              </button>
            </div>
          </div>

          <!-- Tombol Submit -->
          <button type="submit" class="w-full py-3 px-4 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
            Submit
          </button>
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
        hobi_id: [],
      },
      hobis: [],
      newHobby: "",
    };
  },

  methods: {
    toggleSidebar() {
      this.isSidebarOpen = !this.isSidebarOpen;
    },

    addHobby() {
  if (this.newHobby.trim() === "") {
    alert("Masukkan nama hobi!");
    return;
  }
  axios.post("http://127.0.0.1:8000/api/hobi", { name: this.newHobby })
    .then(response => {
      const newHobbyData = response.data;
      this.hobis.push(newHobbyData);
      this.form.hobi_id.push(newHobbyData.id);
      this.newHobby = "";
    })
    .catch(error => {
      console.error("Error adding new hobby:", error);
      alert("Gagal menambahkan hobi baru.");
    });
},

    submitForm() {
      if (this.form.hobi_id.length === 0) {
        alert("Pilih hobi terlebih dahulu.");
        return;
      }

      axios
        .post("http://127.0.0.1:8000/api/siswa", this.form)
        .then((response) => {
          alert("Data berhasil ditambahkan!");
          this.resetForm();
        })
        .catch((error) => {
          alert("Terjadi kesalahan!");
        });
    },

    resetForm() {
      this.form = {
        full_name: "",
        email: "",
        degree: "",
        hobi_id: [],
      };
      this.newHobby = "";
    },
  },

  mounted() {
    axios.get("http://127.0.0.1:8000/api/hobi")
      .then((response) => {
        this.hobis = response.data;
      })
      .catch((error) => {
        console.error("Error loading hobis:", error);
      });
  },
};
</script>
