import { defineStore } from 'pinia';
import axios from 'axios';

const api = axios.create({
    baseURL: 'http://localhost:8000/api',
});

export const useMasterStore = defineStore('masterStore', {
    state: () => ({
        desas: [],
        farmer: [],
        facilitator: [],
        pagination: { current_page: 1, last_page: 1, total: 0 },
        loading: false,
        error: null,
    }),
    actions: {
        async fetchDesa(page = 1, search = '') {
            this.loading = true;
            this.error = null;

            try {
                const response = await api.get(`/desa`, {
                    params: {
                        page,
                        search,
                    },
                });
                this.desas = response.data.data;
                this.pagination = {
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
        },
        async fetchFarmer(page = 1, search = '') {
            this.loading = true;
            this.error = null;

            try {
                const response = await api.get(`/farmer`, {
                    params: {
                        page,
                        search,
                    },
                });
                this.farmer = response.data.data;
                this.pagination = {
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
        },
        async fetchFacilitator(page = 1, search = '') {
            this.loading = true;
            this.error = null;

            try {
                const response = await api.get(`/facilitator`, {
                    params: {
                        page,
                        search,
                    },
                });
                this.facilitator = response.data.data;
                this.pagination = {
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
