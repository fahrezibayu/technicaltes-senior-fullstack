import { defineStore } from 'pinia';
import axios from 'axios';

export const usemasterStore = defineStore('masterStore', {
    state: () => ({
        desas: [],
        loading: false,
        error: null,
    }),
    actions: {
        async fetchItems() {
            this.loading = true;  // Set loading to true
            this.error = null;    // Reset any previous error

            try {
                const response = await axios.get('http://localhost:8000/api/desa');
                this.desas = response.data;
            } catch (error) {
                console.error('Error fetching items:', error);
                this.error = 'Failed to fetch items'; // Set error message
            } finally {
                this.loading = false; // Set loading to false after fetch
            }
        },
    },
});
