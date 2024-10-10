<template>
    <div class="max-w-5xl mx-auto p-2">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Daftar Petani</h1>
        <div class="flex flex-col md:flex-row gap-4 mb-4">
            <div class="flex-1">
                <label class="block text-gray-700">Nama Petani</label>
                <input
                    type="text"
                    v-model="search"
                    placeholder="Cari Nama Desa..."
                    class="w-full p-2 border border-gray-300 rounded-md"
                />
            </div>

            <div class="flex-1">
                <label class="block text-gray-700">Provinsi</label>
                <select
                    v-model="filters.provinsi"
                    class="w-full p-2 border border-gray-300 rounded-md"
                >
                    <option value="">Semua Provinsi</option>
                    <option
                        v-for="prov in provinces"
                        :key="prov.id"
                        :value="prov.province_code"
                    >
                        {{ prov.name }}
                    </option>
                </select>
            </div>

            <div class="flex-1">
                <label class="block text-gray-700">Kabupaten</label>
                <select
                    v-model="filters.kabupaten"
                    class="w-full p-2 border border-gray-300 rounded-md"
                >
                    <option value="">Semua Kabupaten</option>
                    <option
                        v-for="kab in kabupatens"
                        :key="kab.id"
                        :value="kab.kabupaten_no"
                    >
                        {{ kab.name }}
                    </option>
                </select>
            </div>

            <div class="flex-1">
                <label class="block text-gray-700">Kecamatan</label>
                <select
                    v-model="filters.kecamatan"
                    class="w-full p-2 border border-gray-300 rounded-md"
                >
                    <option value="">Semua Kecamatan</option>
                    <option
                        v-for="kec in kecamatans"
                        :key="kec.id"
                        :value="kec.kode_kecamatan"
                    >
                        {{ kec.name }}
                    </option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table
                class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg"
            >
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b">Kode Petani</th>
                        <th class="py-2 px-4 border-b">Nama Petani</th>
                        <th class="py-2 px-4 border-b">Tanggal Lahir</th>
                        <th class="py-2 px-4 border-b">Agama</th>
                        <th class="py-2 px-4 border-b">Suku</th>
                        <th class="py-2 px-4 border-b">Asli</th>
                        <th class="py-2 px-4 border-b">Jenis Kelamin</th>
                        <th class="py-2 px-4 border-b">Tanggal Bergabung</th>
                        <th class="py-2 px-4 border-b">Jumlah Keluarga</th>
                        <th class="py-2 px-4 border-b">No Ktp</th>
                        <th class="py-2 px-4 border-b">No Hp</th>
                        <th class="py-2 px-4 border-b">Alamat</th>
                        <th class="py-2 px-4 border-b">Rt</th>
                        <th class="py-2 px-4 border-b">Rw</th>
                        <th class="py-2 px-4 border-b">Provinsi</th>
                        <th class="py-2 px-4 border-b">Kabupaten</th>
                        <th class="py-2 px-4 border-b">Kecamatan</th>
                        <th class="py-2 px-4 border-b">Kode Pos</th>
                        <th class="py-2 px-4 border-b">Kategori Legal</th>
                        <th class="py-2 px-4 border-b">Nama Area</th>
                        <th class="py-2 px-4 border-b">Nama Unit</th>
                        <th class="py-2 px-4 border-b">No Group</th>
                        <th class="py-2 px-4 border-b">No MOU</th>
                        <th class="py-2 px-4 border-b">Pendapatan Utama</th>
                        <th class="py-2 px-4 border-b">Pendapatan Sampingan</th>
                        <th class="py-2 px-4 border-b">
                            Rata-Rata Pendapatan Perbulan
                        </th>
                        <th class="py-2 px-4 border-b">Mitra Petani</th>
                        <th class="py-2 px-4 border-b">
                            Rata-Rata Pengeluaran Perbulan
                        </th>
                        <th class="py-2 px-4 border-b">
                            Rata-Rata Pendapatan Pertahun
                        </th>
                        <th class="py-2 px-4 border-b">
                            Rata-Rata Pendapatan Bisnis Kayu Pertahun
                        </th>
                        <th class="py-2 px-4 border-b">
                            Rata-Rata Pendapatan Perikanan Pertahun
                        </th>
                        <th class="py-2 px-4 border-b">
                            Rata-Rata Wisata Alam Pertahun
                        </th>
                        <th class="py-2 px-4 border-b">
                            Rata-Rata Sumber Pendapatan Lain Pertahun
                        </th>
                        <th class="py-2 px-4 border-b">Sumber Obat</th>
                        <th class="py-2 px-4 border-b">Sumber Makanan</th>
                        <th class="py-2 px-4 border-b">Sumber Air Minum</th>
                        <th class="py-2 px-4 border-b">Sumber Air Bersih</th>
                        <th class="py-2 px-4 border-b">Status Pernikahan</th>
                        <th class="py-2 px-4 border-b">Pekerjaan Utama</th>
                        <th class="py-2 px-4 border-b">Pekerjaan Sampingan</th>
                        <th class="py-2 px-4 border-b">Pendidikan</th>
                        <th class="py-2 px-4 border-b">
                            Pendidikan Non Formal
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="masterStore.loading">
                        <td
                            colspan="9"
                            class="py-2 px-4 text-center text-blue-500"
                        >
                            Loading...
                        </td>
                    </tr>

                    <tr v-if="masterStore.error">
                        <td
                            colspan="9"
                            class="py-2 px-4 text-center text-red-500"
                        >
                            {{ masterStore.error }}
                        </td>
                    </tr>

                    <tr
                        v-for="(item, index) in farmer"
                        :key="index"
                        class="hover:bg-gray-100"
                    >
                        <td class="py-2 px-4 border-b">{{ item.farmer_no }}</td>
                        <td class="py-2 px-4 border-b">{{ item.name }}</td>
                        <td class="py-2 px-4 border-b">
                            {{ formatTanggal(item.birthday) }}
                        </td>
                        <td class="py-2 px-4 border-b">{{ item.religion }}</td>
                        <td class="py-2 px-4 border-b">{{ item.ethnic }}</td>
                        <td class="py-2 px-4 border-b">{{ item.origin }}</td>
                        <td class="py-2 px-4 border-b">
                            <p v-if="item.gender === 'male'">Perempuan</p>
                            <p v-else>Laki-Laki</p>
                        </td>
                        <td class="py-2 px-4 border-b">
                            {{ formatTanggal(item.join_date) }}
                        </td>
                        <td class="py-2 px-4 border-b">
                            {{ item.number_family_member }}
                        </td>
                        <td class="py-2 px-4 border-b">{{ item.ktp_no }}</td>
                        <td class="py-2 px-4 border-b">{{ item.phone }}</td>
                        <td class="py-2 px-4 border-b">{{ item.address }}</td>
                        <td class="py-2 px-4 border-b">{{ item.rt }}</td>
                        <td class="py-2 px-4 border-b">{{ item.rw }}</td>
                        <td class="py-2 px-4 border-b">
                            {{ item.province.name }}
                        </td>
                        <td class="py-2 px-4 border-b">
                            {{ item.kabupaten.name }}
                        </td>
                        <td class="py-2 px-4 border-b">
                            {{ item.kecamatan.name }}
                        </td>
                        <td class="py-2 px-4 border-b">{{ item.post_code }}</td>
                        <td class="py-2 px-4 border-b">
                            {{ item.legal_land_categories }}
                        </td>
                        <td class="py-2 px-4 border-b">
                            {{ item.target_area_name }}
                        </td>
                        <td class="py-2 px-4 border-b">
                            {{ item.management_unit.name }}
                        </td>
                        <td class="py-2 px-4 border-b">{{ item.group_no }}</td>
                        <td class="py-2 px-4 border-b">{{ item.mou_no }}</td>
                        <td class="py-2 px-4 border-b">
                            {{ formatNumberRupiah(item.main_income) }}
                        </td>
                        <td class="py-2 px-4 border-b">
                            {{ formatNumberRupiah(item.side_income) }}
                        </td>
                        <td class="py-2 px-4 border-b">
                            {{ item.avg_income_permonth }}
                        </td>
                        <td class="py-2 px-4 border-b">
                            {{ item.is_farmer_partner_helping }}
                        </td>
                        <td class="py-2 px-4 border-b">
                            {{ item.avg_food_outcome_monthly }}
                        </td>
                        <td class="py-2 px-4 border-b">
                            {{ item.avg_farming_income_yearly }}
                        </td>
                        <td class="py-2 px-4 border-b">
                            {{ item.avg_wood_bussines_income_yearly }}
                        </td>
                        <td class="py-2 px-4 border-b">
                            {{ item.avg_fishery_income_yearly }}
                        </td>
                        <td class="py-2 px-4 border-b">
                            {{ item.avg_nature_tourism_yearly }}
                        </td>
                        <td class="py-2 px-4 border-b">
                            {{ item.avg_other_source_income_yearly }}
                        </td>
                        <td class="py-2 px-4 border-b">
                            {{ item.general_medicine_source }}
                        </td>
                        <td class="py-2 px-4 border-b">
                            {{ item.general_food_source }}
                        </td>
                        <td class="py-2 px-4 border-b">
                            {{ item.general_drink_water_source }}
                        </td>
                        <td class="py-2 px-4 border-b">
                            {{ item.general_clean_water_source }}
                        </td>
                        <td class="py-2 px-4 border-b">
                            {{ item.marrital_status }}
                        </td>
                        <td class="py-2 px-4 border-b">{{ item.main_job }}</td>
                        <td class="py-2 px-4 border-b">{{ item.side_job }}</td>
                        <td class="py-2 px-4 border-b">{{ item.education }}</td>
                        <td class="py-2 px-4 border-b">
                            {{ item.non_formal_education }}
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
import moment from "moment";

const masterStore = useMasterStore();
const search = ref("");
const filters = ref({
    kecamatan: "",
    provinsi: "",
    kabupaten: "",
});

const fetchItems = (page = 1) => {
    const searchValue = search.value;
    const { kecamatan, provinsi, kabupaten, namaArea } = filters.value;

    masterStore.fetchFarmer(page, searchValue, {
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

onMounted(() => {
    fetchItems();
    fetchKecamatan();
    fetchKabupaten();
    fetchProvince();
});

watch(
    [search, filters],
    () => {
        fetchItems(1);
    },
    { deep: true }
);

const farmer = computed(() => masterStore.farmer);
const pagination = computed(() => masterStore.pagination);
const kecamatans = computed(() => masterStore.kecamatan);
const provinces = computed(() => masterStore.province);
const kabupatens = computed(() => masterStore.kabupaten);

const formatTanggal = (tanggal) => {
    return moment(tanggal).format("D MMMM YYYY");
};

const formatNumberRupiah = (number) => {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
    }).format(number);
};
</script>
