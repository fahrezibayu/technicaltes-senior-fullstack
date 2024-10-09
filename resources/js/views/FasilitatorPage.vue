<template>
    <div class="max-w-5xl mx-auto p-2">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Daftar Fasilitator</h1>
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
                        <th class="py-2 px-4 border-b">Kode Fasilitator</th>
                        <th class="py-2 px-4 border-b">Nama Fasilitator</th>
                        <th class="py-2 px-4 border-b">Tanggal Lahir</th>
                        <th class="py-2 px-4 border-b">Agama</th>
                        <th class="py-2 px-4 border-b">Jenis Kelamin</th>
                        <th class="py-2 px-4 border-b">Tanggal Bergabung</th>
                        <th class="py-2 px-4 border-b">No Ktp</th>
                        <th class="py-2 px-4 border-b">No Hp</th>
                        <th class="py-2 px-4 border-b">Alamat</th>
                        <th class="py-2 px-4 border-b">Rt</th>
                        <th class="py-2 px-4 border-b">Rw</th>
                        <th class="py-2 px-4 border-b">Provinsi</th>
                        <th class="py-2 px-4 border-b">Kabupaten</th>
                        <th class="py-2 px-4 border-b">Kecamatan</th>
                        <th class="py-2 px-4 border-b">Kode Pos</th>
                        <th class="py-2 px-4 border-b">Nama Area</th>
                        <th class="py-2 px-4 border-b">Nama Unit</th>
                        <th class="py-2 px-4 border-b">Account Bank</th>
                        <th class="py-2 px-4 border-b">Nama Bank</th>
                        <th class="py-2 px-4 border-b">Cabang Bank</th>
                        <th class="py-2 px-4 border-b">Status Pernikahan</th>
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
                        <td class="py-2 px-4 border-b">{{ item.ff_no }}</td>
                        <td class="py-2 px-4 border-b">{{ item.name }}</td>
                        <td class="py-2 px-4 border-b">{{ formatTanggal(item.birthday) }}</td>
                        <td class="py-2 px-4 border-b">{{ item.religion }}</td>
                        <td class="py-2 px-4 border-b">
                            <p v-if="item.gender === 'male'"> Perempuan </p>
                            <p v-else> Laki-Laki </p>
                        </td>
                        <td class="py-2 px-4 border-b">{{ formatTanggal(item.join_date) }}</td>
                        <td class="py-2 px-4 border-b">{{ item.ktp_no }}</td>
                        <td class="py-2 px-4 border-b">{{ item.phone }}</td>
                        <td class="py-2 px-4 border-b">{{ item.address }}</td>
                        <td class="py-2 px-4 border-b">{{ item.rt }}</td>
                        <td class="py-2 px-4 border-b">{{ item.rw }}</td>
                        <td class="py-2 px-4 border-b">{{ item.province_name }}</td>
                        <td class="py-2 px-4 border-b">{{ item.kabupaten_name }}</td>
                        <td class="py-2 px-4 border-b">{{ item.kecamatan_name }}</td>
                        <td class="py-2 px-4 border-b">{{ item.post_code }}</td>
                        <td class="py-2 px-4 border-b">{{ item.target_area_name }}</td>
                        <td class="py-2 px-4 border-b">{{ item.management_unit.name }}</td>
                        <td class="py-2 px-4 border-b">{{ item.bank_account }}</td>
                        <td class="py-2 px-4 border-b">{{ item.bank_name }}</td>
                        <td class="py-2 px-4 border-b">{{ item.bank_branch }}</td>
                        <td class="py-2 px-4 border-b">{{ item.marrital }}</td>
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
import moment from "moment"

const masterStore = useMasterStore();
const search = ref("");

const fetchItems = (page = 1) => {
    masterStore.fetchFacilitator(page, search.value);
};

onMounted(() => {
    fetchItems();
});

watch(search, () => {
    fetchItems(1);
});

const desas = computed(() => masterStore.facilitator);
const pagination = computed(() => masterStore.pagination);

const formatTanggal = (tanggal) => {
    return moment(tanggal).format('D MMMM YYYY');
};

</script>
