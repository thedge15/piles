<template>
    <aside class="fixed inset-y-0 left-0 shadow-md max-h-screen w-60 bg-gradient-to-r from-gray-500 to-gray-200">
        <div class="flex flex-col justify-between h-full">
            <div class="flex-grow">
                <div class="px-4 py-6 text-center border-b">
                    <h1 class="text-xl font-bold leading-none"><span
                        class="text-yellow-700">Меню</span></h1>
                </div>
                <div class="p-4">
                    <ul class="space-y-1">
                        <li class="my-2">
                            <Link :href="route('dashboard')"
                                  :class="['flex rounded-xl font-bold text-sm py-1 px-4', $page.component === 'Dashboard' ? 'items-center text-yellow-900 bg-yellow-200' : 'text-gray-900 bg-white hover:bg-yellow-50']">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                     class="text-lg mr-4" viewBox="0 0 16 16">
                                    <path
                                        d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                                Кусты
                            </Link>
                        </li>
                        <li class="my-2">
                            <Link :href="route('index.elements')"
                                  :class="['flex rounded-xl font-bold text-sm py-1 px-4', $page.component === 'Element/Index' ? 'items-center text-yellow-900 bg-yellow-200' : 'text-gray-900 bg-white hover:bg-yellow-50']">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                     class="text-lg mr-4" viewBox="0 0 16 16">
                                    <path
                                        d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                                Элементы
                            </Link>
                        </li>
                        <li v-if="$page.props.auth.user.is_admin === 1" class="my-2">
                            <Link :href="route('bush.index')"
                                  class='flex rounded-xl font-bold text-sm py-1 px-4 text-gray-900 bg-white hover:bg-yellow-50'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                     class="text-lg mr-4" viewBox="0 0 16 16">
                                    <path
                                        d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                                Админпанель
                            </Link>
                        </li>
                        <li v-if="$page.component === 'Material/Index'" class="py-10 text-center">

                            <button @click="change()" type="button"
                                    class="w-1/2 text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600
                        hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300
                        dark:focus:ring-teal-800 font-medium rounded-lg text-sm px-3 py-2 text-center mr-2 mb-2">
                                Создать
                            </button>
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

    data() {
        return {

        }
    },

    methods: {
        change()
        {

        }
    }
}

</script>

<style scoped>

</style>
