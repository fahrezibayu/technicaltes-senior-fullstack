import { defineStore } from 'pinia';
import axios from 'axios';

export const usemasterStore = defineStore('masterStore', {
    state: () => ({
        desas: [],
        pagination: { current_page: 1, last_page: 1, total: 0 }, // Tambahkan pagination
        loading: false,
        error: null,
    }),
    actions: {
        async fetchDesa(page = 1, search = '') {
            this.loading = true; // Set loading to true
            this.error = null;   // Reset any previous error

            try {
                const response = await axios.get(`http://localhost:8000/api/desa`, {
                    params: {
                        page,
                        search,
                    },
                });
                console.log(response.data); // Periksa respons API
                this.desas = response.data.data;
                this.pagination = { // Pastikan Anda menyimpan pagination dengan benar
                    current_page: response.data.current_page,
                    last_page: response.data.last_page,
                    total: response.data.total,
                };
            } catch (error) {
                console.error('Error fetching items:', error);
                this.error = 'Failed to fetch items';
            } finally {
                this.loading = false;
            }
        }
    },
});
