<template>
    <aside class="fixed inset-y-0 left-0 shadow-md max-h-screen w-60 bg-gradient-to-r from-gray-500 to-gray-200">
        <div class="flex flex-col justify-between h-full">
            <div class="flex-grow">
                <div class="px-4 py-6 text-center border-b">
                    <h1 class="text-xl font-bold leading-none"><span
                        class="text-yellow-700">Метал</span></h1>
                </div>
                <div class="p-4">
                    <ul class="space-y-1">
                        <li>
                            <Link :href="route('bush.index')"
                                  :class="['flex rounded-xl font-bold text-sm py-1 px-4', $page.component === 'Bush/Index' ? 'items-center text-yellow-900 bg-yellow-200' : 'text-gray-900 bg-white hover:bg-yellow-50']">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                     class="text-lg mr-4" viewBox="0 0 16 16">
                                    <path
                                        d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                                Кусты
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('specification.metal')"
                                  :class="['flex rounded-xl font-bold text-sm py-1 px-4', $page.component === 'Metal/Index' ? 'items-center text-yellow-900 bg-yellow-200' : 'text-gray-900 bg-white hover:bg-yellow-50']">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                     class="text-lg mr-4" viewBox="0 0 16 16">
                                    <path
                                        d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.825a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"/>
                                </svg>
                                Прокат
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('specification.standard')"
                                  :class="['flex rounded-xl font-bold text-sm py-1 px-4', $page.component === 'Standard/Index' ? 'items-center text-yellow-900 bg-yellow-200' : 'text-gray-900 bg-white hover:bg-yellow-50']">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                     class="text-lg mr-4" viewBox="0 0 16 16">
                                    <path
                                        d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.825a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"/>
                                </svg>
                                ГОСТы
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('specification.steel')"
                                  :class="['flex rounded-xl font-bold text-sm py-1 px-4', $page.component === 'Steel/Index' ? 'items-center text-yellow-900 bg-yellow-200' : 'text-gray-900 bg-white hover:bg-yellow-50']">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                     class="text-lg mr-4" viewBox="0 0 16 16">
                                    <path
                                        d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.825a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"/>
                                </svg>
                                Сталь
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('specification.unit')"
                                  :class="['flex rounded-xl font-bold text-sm py-1 px-4', $page.component === 'Unit/Index' ? 'items-center text-yellow-900 bg-yellow-200' : 'text-gray-900 bg-white hover:bg-yellow-50']">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                     class="text-lg mr-4" viewBox="0 0 16 16">
                                    <path
                                        d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.825a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"/>
                                </svg>
                                Единицы измерения
                            </Link>
                        </li>
                        <li >
                            <Link :href="route('paint.index')"
                                  :class="['flex rounded-xl font-bold text-sm py-1 px-4', $page.component === 'Paint/Index' ? 'items-center text-yellow-900 bg-yellow-200' : 'text-gray-900 bg-white hover:bg-yellow-50']">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                     class="text-lg mr-4" viewBox="0 0 16 16">
                                    <path
                                        d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.825a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"/>
                                </svg>
                                Краска
                            </Link>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="p-4 mx-auto">
                <button type="button"
                        class="inline-flex items-center justify-center h-9 px-4 rounded-xl bg-gray-900 text-gray-300 hover:text-white text-sm font-semibold transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class=""
                         viewBox="0 0 16 16">
                        <path
                            d="M12 1a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2a1 1 0 0 1 1-1h8zm-2 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                    </svg>
                </button>
                <Link :href="route('logout')" method="post" class="font-bold text-sm ml-2">Logout</Link>
            </div>
        </div>
    </aside>
</template>

<script>

import {Link} from "@inertiajs/vue3";

export default {

    name: "Sidebar",

    components: {
        Link
    },
}

</script>

<style scoped>

</style>
