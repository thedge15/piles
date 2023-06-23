<template>
    <main class="ml-60 pt-16 max-h-screen overflow-auto">
        <div class="px-6 py-8 bg-cover">
            <div class="text-center font-bold text-black">
                Краска
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
                <button @click.prevent="this.hideUnit = !hideUnit" type="button"
                        class="mb-4 text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600
                        hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300
                        dark:focus:ring-teal-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    Создать
                </button>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4 bg-lime-50">
                    <div class="table-wrp block max-h-96">
                        <table v-if="paints" class="w-full text-sm text-left text-blue-100 dark:text-blue-100">
                            <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white sticky top-0">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    №
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Наименование краски
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Расход краски
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Цвет краски
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Удаление
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item, index) in paints" class="bg-blue-500 border-b border-blue-400">
                                <td class="px-6">
                                    {{ index + 1 }}
                                </td>
                                <th scope="row"
                                    class="px-6 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100 text-center">
                                    {{ item.title }}
                                </th>
                                <td class="px-6 text-center">
                                    {{ item.consumption }}
                                </td>
                                <td class="px-6 text-center">
                                    {{ item.color }}
                                </td>
                                <td class="px-6 text-center">
                                    <svg @click.prevent="deletePaint(item.id)"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-6 h-6 mx-auto cursor-pointer">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                    </svg>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div :class="['relative', this.hideUnit ? '' : 'hidden']">
                            <form class="p-4">
                                <div class="flex">
                                    <div class="grid gap-6 mb-6 md:grid-cols-3 w-full">
                                        <div>
                                            <label for="title" class="text-amber=200 mb-2">Наименование краски</label>
                                            <input v-model="title" type="text" id="title"
                                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                   placeholder="Наименование краски" required>
                                        </div>
                                        <div>
                                            <label for="consumption" class="text-amber=200 mb-2">Расход краски, кг/м<sup>2</sup></label>
                                            <input v-model="consumption" type="number" step="any" id="consumption"
                                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                   placeholder="Расход краски" required>
                                        </div>
                                        <div>
                                            <label for="title" class="text-amber=200 mb-2">Цвет краски</label>
                                            <input v-model="color" type="text" id="title"
                                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                   placeholder="Цвет краски" required>
                                        </div>
                                    </div>
                                </div>
                                <button @click.prevent="addPaint" type="button"
                                        class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500
                                hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300
                                dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                    Добавить
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>

import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {

    name: "Index",

    layout: AdminLayout,

    components: {
        Link
    },

    data() {
        return {
            hideDelete: false,
            hideUnit: false,
            hideUpdate: false,
            title: '',
            consumption: null,
            color: '',
            delId: null,
            delTitle: '',
        }
    },

    props: [
        'paints',
    ],

    methods: {
        addPaint() {
            this.$inertia.post('/admin/paints', {
                title: this.title,
                consumption: this.consumption,
                color: this.color,
            })
            this.title = ''
            this.consumption = null
            this.color = ''
            this.hideUnit = !this.hideUnit
        },

        deletePaint(id) {
            this.$inertia.delete(route('paint.destroy', id))
            this.delId = null
            this.delTitle = ''
            this.hideDelete = !this.hideDelete
        }
    }
}
</script>

<style scoped>

</style>
