<template>
    <main class="ml-60 pt-16 max-h-screen overflow-auto">
        <div class="px-6 py-8">
            <div class="text-center font-bold">
                КУСТЫ
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <button @click.prevent="hideBush = !hideBush" type="button"
                        class="mb-4 text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    Создать
                </button>
                <!--                </Link>-->
                <div :class="['relative overflow-x-auto shadow-md sm:rounded-lg', this.hideBush ? '' : 'hidden']">
                    <form class="p-4">
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <input v-model="title" type="text"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="Наименование куста" required>
                            </div>
                        </div>
                        <button @click.prevent="addBush" type="button"
                                class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                            Добавить
                        </button>
                    </form>
                </div>
                <table v-if="bushes" class="w-full text-sm text-left text-blue-100 dark:text-blue-100">
                    <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white mb-6">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            №
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Наименование куста
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Просмотр
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Редактирование
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="bush in bushes.data" class="bg-blue-500 border-b border-blue-400">
                        <td class="px-6 py-4">
                            {{ bush.id }}
                        </td>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100 text-center">
                            {{ bush.title }}
                        </th>
                        <td class="px-6 py-4">
                            <Link :href="route('bush.show', bush.id)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="w-6 h-6 mx-auto cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </Link>
                        </td>
                        <td class="px-6 py-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6 mx-auto cursor-pointer">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                            </svg>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</template>

<script>

import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {

    name: "Index",

    data() {
        return {
            bush: this.bush,
            hideBush: false,
            title: '',
        }
    },

    layout: AdminLayout,

    components: {
        Link
    },

    methods: {
        addBush() {
            this.$inertia.post('/admin/bushes', {title: this.title})
            this.hideBush = !this.hideBush
            this.title = ''
        },
    },

    props: [
        'bushes',
    ],

}
</script>

<style scoped>

</style>
