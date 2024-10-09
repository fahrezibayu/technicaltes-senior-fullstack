<template>
    <div class="max-w-5xl mx-auto p-2">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Daftar Desa</h1>
        <input
            type="text"
            v-model="search"
            placeholder="Cari desa..."
            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4"
        />

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b">Kode Desa</th>
                        <th class="py-2 px-4 border-b">Nama Desa</th>
                        <th class="py-2 px-4 border-b">Nama Area</th>
                        <th class="py-2 px-4 border-b">Luas</th>
                        <th class="py-2 px-4 border-b">Provinsi</th>
                        <th class="py-2 px-4 border-b">Kabupaten</th>
                        <th class="py-2 px-4 border-b">Kecamatan</th>
                        <th class="py-2 px-4 border-b">Program Tahunan</th>
                        <th class="py-2 px-4 border-b">Status Desa</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="masterStore.loading">
                        <td colspan="9" class="py-2 px-4 text-center text-blue-500">
                            Loading...
                        </td>
                    </tr>

                    <tr v-if="masterStore.error">
                        <td colspan="9" class="py-2 px-4 text-center text-red-500">
                            {{ masterStore.error }}
                        </td>
                    </tr>

                    <tr v-for="(item, index) in desas" :key="index" class="hover:bg-gray-100">
                        <td class="py-2 px-4 border-b">{{ item.kode_desa }}</td>
                        <td class="py-2 px-4 border-b">{{ item.name }}</td>
                        <td class="py-2 px-4 border-b">{{ item.target_area.name }}</td>
                        <td class="py-2 px-4 border-b">{{ item.target_area.luas }}</td>
                        <td class="py-2 px-4 border-b">{{ item.target_area.province.name }}</td>
                        <td class="py-2 px-4 border-b">{{ item.target_area.kabupaten.name }}</td>
                        <td class="py-2 px-4 border-b">{{ item.kecamatan.name }}</td>
                        <td class="py-2 px-4 border-b">{{ item.program_year }}</td>
                        <td class="py-2 px-4 border-b">
                            <p v-if="item.status === 0"> Belum Mengikuti RRA </p>
                            <p v-if="item.status === 1"> Potensial </p>
                            <p v-if="item.status === 2"> Tidak Potensial </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

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
import { ref, computed, onMounted, watch } from "vue";
import { useMasterStore } from "../stores/masterStore";

const masterStore = useMasterStore();
const search = ref("");

const fetchItems = (page = 1) => {
    masterStore.fetchDesa(page, search.value);
};

onMounted(() => {
    fetchItems();
});

watch(search, () => {
    fetchItems(1);
});

const desas = computed(() => masterStore.desas);
const pagination = computed(() => masterStore.pagination);
</script>
