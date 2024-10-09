<template>
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Daftar Desa</h1>
        <input
            type="text"
            v-model="search"
            placeholder="Cari desa..."
            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4"
        />

        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border-b">Nama</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loading Indicator -->
                <tr v-if="masterStore.loading">
                    <td colspan="1" class="py-2 px-4 text-center text-blue-500">
                        Loading...
                    </td>
                </tr>

                <!-- Error Message -->
                <tr v-if="masterStore.error">
                    <td colspan="1" class="py-2 px-4 text-center text-red-500">
                        {{ masterStore.error }}
                    </td>
                </tr>

                <!-- Data Rows -->
                <tr v-for="(item, index) in desas" :key="index" class="hover:bg-gray-100">
                    <td class="py-2 px-4 border-b">{{ item.name }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="flex justify-between items-center mt-4">
            <button
                @click="fetchItems(pagination.current_page - 1)"
                :disabled="pagination.current_page === 1"
                class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 disabled:opacity-50"
            >
                Previous
            </button>
            <span class="text-gray-600">
                Page {{ pagination.current_page }} of {{ pagination.last_page }}
            </span>
            <button
                @click="fetchItems(pagination.current_page + 1)"
                :disabled="pagination.current_page === pagination.last_page"
                class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 disabled:opacity-50"
            >
                Next
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue';
import { usemasterStore } from '../stores/masterStore';

const masterStore = usemasterStore();
const search = ref('');

// Fungsi untuk mengambil data desa
const fetchItems = (page = 1) => {
    masterStore.fetchDesa(page, search.value);
};

// Ambil data desa saat komponen dimuat
onMounted(() => {
    fetchItems(); // Ambil data desa saat komponen dimuat
});

// Mengawasi perubahan pada parameter pencarian
watch(search, () => {
    fetchItems(1); // Reset ke halaman 1 pada pencarian
});

// Mendapatkan data desa dan informasi pagination dari store
const desas = computed(() => masterStore.desas);
const pagination = computed(() => masterStore.pagination); // Mengambil pagination
</script>
