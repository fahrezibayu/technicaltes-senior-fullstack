<template>
    <div class="max-w-5xl mx-auto p-2">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Daftar Desa</h1>

        <div class="flex flex-col md:flex-row gap-4 mb-4">

            <div class="flex-1">
                <label class="block text-gray-700">Nama Desa</label>
                <input
                    type="text"
                    v-model="search"
                    placeholder="Cari Nama Desa..."
                    class="w-full p-2 border border-gray-300 rounded-md"
                />
            </div>

            <div class="flex-1">
                <label class="block text-gray-700">Provinsi</label>
                <select v-model="filters.provinsi" class="w-full p-2 border border-gray-300 rounded-md">
                    <option value="">Semua Provinsi</option>
                    <option v-for="prov in provinces" :key="prov.id" :value="prov.province_code">{{ prov.name }}</option>
                </select>
            </div>

            <div class="flex-1">
                <label class="block text-gray-700">Kabupaten</label>
                <select v-model="filters.kabupaten" class="w-full p-2 border border-gray-300 rounded-md">
                    <option value="">Semua Kabupaten</option>
                    <option v-for="kab in kabupatens" :key="kab.id" :value="kab.kabupaten_no">{{ kab.name }}</option>
                </select>
            </div>

            <div class="flex-1">
                <label class="block text-gray-700">Kecamatan</label>
                <select v-model="filters.kecamatan" class="w-full p-2 border border-gray-300 rounded-md">
                    <option value="">Semua Kecamatan</option>
                    <option v-for="kec in kecamatans" :key="kec.id" :value="kec.kode_kecamatan">{{ kec.name }}</option>
                </select>
            </div>

        </div>

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
                        <td class="py-2 px-4 border-b">{{ item.target_area?.name || '' }}</td>
                        <td class="py-2 px-4 border-b">{{ item.target_area?.luas || '0' }}</td>
                        <td class="py-2 px-4 border-b">{{ item.kecamatan?.kabupaten?.province?.name || '' }}</td>
                        <td class="py-2 px-4 border-b">{{ item.kecamatan?.kabupaten?.name || '' }}</td>
                        <td class="py-2 px-4 border-b">{{ item.kecamatan?.name || '' }}</td>
                        <td class="py-2 px-4 border-b">{{ item.program_year }}</td>
                        <td class="py-2 px-4 border-b">
                            <p v-if="item.status === 0">Belum Mengikuti RRA</p>
                            <p v-if="item.status === 1">Potensial</p>
                            <p v-if="item.status === 2">Tidak Potensial</p>
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

const filters = ref({
    kecamatan: "",
    provinsi: "",
    kabupaten: ""
});

const fetchItems = (page = 1) => {
    const searchValue = search.value;
    const { kecamatan, provinsi, kabupaten, namaArea } = filters.value;

    masterStore.fetchDesa(page, searchValue, {
        kecamatan,
        provinsi,
        kabupaten,
        namaArea,
    });
};

const fetchKecamatan = (page = 1) => {
    masterStore.fetchKecamatan();
};
const fetchKabupaten = (page = 1) => {
    masterStore.fetchKabupaten();
};
const fetchProvince = (page = 1) => {
    masterStore.fetchProvince();
};

watch([search, filters], () => {
    fetchItems(1);
}, { deep: true });

onMounted(() => {
    fetchItems();
    fetchKecamatan()
    fetchKabupaten()
    fetchProvince()
});

const desas = computed(() => masterStore.desas);
const pagination = computed(() => masterStore.pagination);
const kecamatans = computed(() => masterStore.kecamatan);
const provinces = computed(() => masterStore.province);
const kabupatens = computed(() => masterStore.kabupaten);
</script>
