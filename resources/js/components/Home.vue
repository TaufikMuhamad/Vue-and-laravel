<template>
    <div class="flex h-screen">
      <!-- Sidebar -->
      <Sidebar :isSidebarOpen="isSidebarOpen" @toggleSidebar="toggleSidebar" />

      <!-- Main Content -->
      <div class="flex-1 p-8">
        <span
          v-if="!isSidebarOpen"
          @click="toggleSidebar"
          class="absolute text-white text-4xl top-5 left-4 cursor-pointer lg:hidden z-10"
        >
          <i class="bi bi-filter-left px-2 bg-gray-900 rounded-md"></i>
        </span>

        <!-- Daftar Pelajar -->
        <h1 class="text-2xl font-bold mb-4">Daftar Pelajar</h1>
        <div v-if="students.length === 0" class="text-gray-500">Belum ada pelajar yang ditambahkan.</div>

        <!-- Tabel Daftar Siswa -->
        <div v-else>
          <table class="min-w-full table-auto">
            <thead>
              <tr>
                <th class="border-b p-2 text-left">Full Name</th>
                <th class="border-b p-2 text-left">Email</th>
                <th class="border-b p-2 text-left">Degree</th>
                <th class="border-b p-2 text-left">Hobi</th>
                <th class="border-b p-2 text-left">Actions</th> 
              </tr>
            </thead>
            <tbody>
              <tr v-for="student in students" :key="student.id">
                <td class="border-b p-2">{{ student.full_name }}</td>
                <td class="border-b p-2">{{ student.email }}</td>
                <td class="border-b p-2">{{ student.degree }}</td>
                <td class="border-b p-2">{{ student.hobi ? student.hobi.name : 'No Hobi' }}</td>
                <td class="border-b p-2">
                  <!-- Tombol Edit -->
                  <button
                    @click="editStudent(student)"
                    class="bg-yellow-500 text-white px-2 py-1 rounded mr-2"
                  >
                    Edit
                  </button>
                  <!-- Tombol Delete -->
                  <button
                    @click="deleteStudent(student.id)"
                    class="bg-red-500 text-white px-2 py-1 rounded"
                  >
                    Delete
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Modal Edit Form -->
        <div v-if="isEditing" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center">
          <div class="bg-white p-6 rounded shadow-lg w-96">
            <h2 class="text-2xl font-bold mb-4">Edit Pelajar</h2>
            <form @submit.prevent="updateStudent">
              <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                <input
                  v-model="editForm.full_name"
                  type="text"
                  class="mt-1 block w-full p-2 border border-gray-300 rounded"
                  required
                />
              </div>
              <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input
                  v-model="editForm.email"
                  type="email"
                  class="mt-1 block w-full p-2 border border-gray-300 rounded"
                  required
                />
              </div>
              <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Degree</label>
                <input
                  v-model="editForm.degree"
                  type="text"
                  class="mt-1 block w-full p-2 border border-gray-300 rounded"
                  required
                />
              </div>
              <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Hobi</label>
                <select
                  v-model="editForm.hobi_id"
                  class="mt-1 block w-full p-2 border border-gray-300 rounded"
                  required
                >
                  <option v-for="hobi in hobis" :key="hobi.id" :value="hobi.id">{{ hobi.name }}</option>
                </select>
              </div>
              <button
                type="submit"
                class="w-full py-2 px-4 bg-blue-600 text-white rounded hover:bg-blue-700"
              >
                Update
              </button>
              <button
                type="button"
                @click="cancelEdit"
                class="w-full py-2 px-4 bg-gray-500 text-white rounded mt-2 hover:bg-gray-600"
              >
                Cancel
              </button>
            </form>
          </div>
        </div>
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
    setup() {
      const isSidebarOpen = ref(true);
      const students = ref([]);
      const hobis = ref([]);
      const isEditing = ref(false);
      const editForm = ref({
        id: null,
        full_name: "",
        email: "",
        degree: "",
        hobi_id: null,
      });

      const toggleSidebar = () => {
        isSidebarOpen.value = !isSidebarOpen.value;
      };

      onMounted(() => {
        axios
          .get("http://127.0.0.1:8000/api/siswa")
          .then((response) => {
            students.value = response.data;
          })
          .catch((error) => {
            console.error("Error fetching students:", error);
          });

        axios
          .get("http://127.0.0.1:8000/api/hobi")
          .then((response) => {
            hobis.value = response.data;
          })
          .catch((error) => {
            console.error("Error fetching hobbies:", error);
          });
      });

      const deleteStudent = (id) => {
        axios
          .delete(`http://127.0.0.1:8000/api/siswa/${id}`)
          .then((response) => {
            students.value = students.value.filter((student) => student.id !== id);
          })
          .catch((error) => {
            console.error("Error deleting student:", error);
          });
      };

      const editStudent = (student) => {
        editForm.value = { ...student };
        isEditing.value = true;
      };
      const cancelEdit = () => {
        isEditing.value = false;
        editForm.value = {
          id: null,
          full_name: "",
          email: "",
          degree: "",
          hobi_id: null,
        };
      };

      const updateStudent = () => {
        axios
          .put(`http://127.0.0.1:8000/api/siswa/${editForm.value.id}`, editForm.value)
          .then((response) => {
            const index = students.value.findIndex(
              (student) => student.id === editForm.value.id
            );
            students.value[index] = response.data;
            isEditing.value = false;
            alert("Data berhasil diupdate!");
          })
          .catch((error) => {
            console.error("Error updating student:", error);
            alert("Terjadi kesalahan saat memperbarui data!");
          });
      };

      return {
        isSidebarOpen,
        toggleSidebar,
        students,
        deleteStudent,
        isEditing,
        editForm,
        hobis,
        editStudent,
        cancelEdit,
        updateStudent,
      };
    },
  };
  </script>

  <style scoped>

  </style>
