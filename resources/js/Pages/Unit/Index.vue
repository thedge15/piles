<template>
    <div class="flex flex-col h-screen py-5">
        <p class="text-center italic">Единицы измерения</p>
        <button @click.prevent="this.hideUnit = !hideUnit" type="button"
                class="w-1/12 mb-2 text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600
                        hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300
                        dark:focus:ring-teal-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
            Создать
        </button>
        <!-- component -->
        <div class="flex-grow overflow-auto">
            <table class="relative w-full border mb-3">
                <thead>
                <tr>
                    <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">№</th>
                    <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Наименование единиц измерения</th>
                    <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Удаление</th>
                </tr>
                </thead>
                <tbody class="divide-y bg-gray-100">
                <tr v-for="(unit, index) in units">
                    <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ index + 1 }}</td>
                    <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                        {{ unit.title }}
                    </td>
                    <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                        <svg @click.prevent="showDelete(unit.id, unit.title)"
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
                                <label for="title" class="text-amber=200 mb-2">Единицы измерения</label>
                                <input v-model="title" type="text" id="title"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="Единицы измерения" required>
                            </div>
                        </div>
                    </div>
                    <button @click.prevent="addUnit" type="button"
                            class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500
                                hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300
                                dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        Добавить
                    </button>
                </form>
            </div>
            <div :class="['ml-6 mt-3', hideDelete ? '' : 'hidden']">
                <h1 class="italic mb-3">Удалить {{ this.delTitle }}?</h1>
                <div class="flex">
                    <button @click.prevent="deleteUnit" type="button"
                            class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        Удалить
                    </button>
                    <button @click.prevent="this.hideDelete = !this.hideDelete" type="button"
                            class="text-white bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        Отмена
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import {Link} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

export default {

    name: "Index",

    layout: AuthenticatedLayout,

    components: {
        Link
    },

    data() {
        return {
            hideDelete: false,
            hideUnit: false,
            hideUpdate: false,
            title: '',
            delId: null,
            delTitle: '',
        }
    },

    props: [
        'units',
    ],

    methods: {
        addUnit() {
            this.$inertia.post('/admin/units', {
                title: this.title,
            })
            this.title = ''
            this.hideUnit = !this.hideUnit
        },

        showDelete(id, title) {
            this.hideDelete = !this.hideDelete
            this.delId = id
            this.delTitle = title
        },

        deleteUnit() {
            this.$inertia.delete(route('unit.destroy', this.delId))
            this.delId = null
            this.delTitle = ''
            this.hideDelete = !this.hideDelete
        }
    }
}
</script>

<style scoped>

</style>
