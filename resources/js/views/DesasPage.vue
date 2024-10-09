<template>
    <div class="text-center">
        <p>Daftar Desa</p>
        <table width="100%">
            <thead>
                <tr>
                    <th>Nama</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="loading">
                    <td colspan="1">Loading...</td>
                </tr>
                <tr v-if="error">
                    <td colspan="1">{{ error }}</td>
                </tr>
                <tr v-for="(item, index) in desas" :key="index">
                    <td>{{ item.name }}</td>
                </tr>
                <tr v-if="!desas.length && !loading && !error">
                    <td colspan="1">No data available</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { onMounted, computed, ref } from 'vue';
import { usemasterStore } from '../stores/masterStore';

const masterStore = usemasterStore();
const loading = ref(true);
const error = ref(null);

onMounted(async () => {
    try {
        await masterStore.fetchItems();
    } catch (err) {
        error.value = 'Failed to fetch data';
    } finally {
        loading.value = false;
    }
});

const desas = computed(() => masterStore.desas);
</script>
