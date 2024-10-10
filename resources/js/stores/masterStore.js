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
        kecamatan: [],
        kabupaten: [],
        province: [],
        pagination: { current_page: 1, last_page: 1, total: 0 },
        loading: false,
        error: null,
    }),
    actions: {
        async fetchDesa(page = 1, search = '', filters = {}) {
            this.loading = true;
            this.error = null;

            try {
                const response = await api.get(`/desa`, {
                    params: {
                        page,
                        search,
                        ...filters,
                    },
                });

                if (response.data.data.length === 0) {
                    this.error = 'Tidak ada desa yang ditemukan.';
                    this.desas = response.data.data;
                    this.pagination = {
                        current_page: response.data.current_page,
                        last_page: response.data.last_page,
                        total: response.data.total,
                    };
                } else {
                    this.desas = response.data.data;
                    this.pagination = {
                        current_page: response.data.current_page,
                        last_page: response.data.last_page,
                        total: response.data.total,
                    };
                }
            } catch (error) {
                console.error('Error fetching items:', error);
                this.error = 'Gagal mengambil data desa.';
            } finally {
                this.loading = false;
            }
        },
        async fetchFarmer(page = 1, search = '', filters = {}) {
            this.loading = true;
            this.error = null;

            try {
                const response = await api.get(`/farmer`, {
                    params: {
                        page,
                        search,
                        ...filters,
                    },
                });

                if (response.data.data.length === 0) {
                    this.error = 'Tidak ada petani yang ditemukan.';
                    this.farmer = response.data.data;
                    this.pagination = {
                        current_page: response.data.current_page,
                        last_page: response.data.last_page,
                        total: response.data.total,
                    };
                } else {
                    this.farmer = response.data.data;
                    this.pagination = {
                        current_page: response.data.current_page,
                        last_page: response.data.last_page,
                        total: response.data.total,
                    };
                }
            } catch (error) {
                console.error('Error fetching items:', error);
                this.error = 'Gagal mengambil data petani.';
            } finally {
                this.loading = false;
            }
        },
        async fetchFacilitator(page = 1, search = '', filters = {}) {
            this.loading = true;
            this.error = null;

            try {
                const response = await api.get(`/facilitator`, {
                    params: {
                        page,
                        search,
                        ...filters,
                    },
                });

                if (response.data.data.length === 0) {
                    this.error = 'Tidak ada facilitator yang ditemukan.';
                    this.facilitator = response.data.data;
                    this.pagination = {
                        current_page: response.data.current_page,
                        last_page: response.data.last_page,
                        total: response.data.total,
                    };
                } else {
                    this.facilitator = response.data.data;
                    this.pagination = {
                        current_page: response.data.current_page,
                        last_page: response.data.last_page,
                        total: response.data.total,
                    };
                }
            } catch (error) {
                console.error('Error fetching items:', error);
                this.error = 'Gagal mengambil data petani.';
            } finally {
                this.loading = false;
            }
        },
        async fetchKecamatan() {
            this.loading = true;
            this.error = null;

            try {
                const response = await api.get(`/kecamatan`);
                console.log(response.data);
                this.kecamatan = response.data;
            } catch (error) {
                console.error('Error fetching items:', error);
                this.error = 'Failed to fetch items';
            } finally {
                this.loading = false;
            }
        },
        async fetchKabupaten() {
            this.loading = true;
            this.error = null;

            try {
                const response = await api.get(`/kabupaten`)
                this.kabupaten = response.data;
            } catch (error) {
                console.error('Error fetching items:', error);
                this.error = 'Failed to fetch items';
            } finally {
                this.loading = false;
            }
        },
        async fetchProvince() {
            this.loading = true;
            this.error = null;

            try {
                const response = await api.get(`/province`);
                this.province = response.data;
            } catch (error) {
                console.error('Error fetching items:', error);
                this.error = 'Failed to fetch items';
            } finally {
                this.loading = false;
            }
        }
    },
});
