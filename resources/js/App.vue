<template>
    <div class="bg-white">
        <header class="absolute inset-x-0 top-0 z-50">
            <nav
                class="flex items-center justify-between p-6 lg:px-8"
                aria-label="Global"
            >
                <div class="flex lg:flex-1">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="sr-only">Technical Tes</span>
                        <h3>Technical Tes Senior</h3>
                    </a>
                </div>
                <div class="flex lg:hidden">
                    <button
                        type="button"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
                        @click="mobileMenuOpen = true"
                    >
                        <span class="sr-only">Open main menu</span>
                        <Bars3Icon class="h-6 w-6" aria-hidden="true" />
                    </button>
                </div>
                <div
                    class="hidden lg:flex lg:flex-1 lg:justify-end lg:gap-x-12"
                >
                    <router-link
                        v-for="item in navigation"
                        :key="item.name"
                        :to="item.href"
                        class="text-lg font-semibold leading-6 text-gray-900 hover:text-blue-600"
                    >
                        {{ item.name }}
                    </router-link>
                </div>
            </nav>
            <Dialog
                class="lg:hidden"
                @close="mobileMenuOpen = false"
                :open="mobileMenuOpen"
            >
                <div class="fixed inset-0 z-50" />
                <DialogPanel
                    class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10"
                >
                    <div class="flex items-center justify-between">
                        <a href="#" class="-m-1.5 p-1.5">
                            <span class="sr-only">Your Company</span>
                            <h3>Technical Tes Senior</h3>
                        </a>
                        <button
                            type="button"
                            class="-m-2.5 rounded-md p-2.5 text-gray-700"
                            @click="mobileMenuOpen = false"
                        >
                            <span class="sr-only">Close menu</span>
                            <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                        </button>
                    </div>
                    <div class="mt-6 flow-root">
                        <div class="-my-6 divide-y divide-gray-500/10">
                            <div class="space-y-2 py-6">
                                <router-link
                                    v-for="item in navigation"
                                    :key="item.name"
                                    :to="item.href"
                                    class="block py-2 pl-3 pr-4 rounded font-semibold leading-7 text-gray-900 hover:bg-gray-200 md:hover:bg-transparent md:border-0 md:hover:text-white md:p-0"
                                >
                                    {{ item.name }}
                                </router-link>
                            </div>
                        </div>
                    </div>
                </DialogPanel>
            </Dialog>
        </header>

        <div class="relative isolate px-6 pt-28 lg:px-8">
            <router-view></router-view>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { Dialog, DialogPanel } from "@headlessui/vue";
import { Bars3Icon, XMarkIcon } from "@heroicons/vue/24/outline";

const navigation = [
    { name: "Desa", href: "/" },
    { name: "Petani", href: "/petani" },
    { name: "Fasilitator", href: "/fasilitator" },
];

const mobileMenuOpen = ref(false);
</script>
