<template>
    <main class="ml-60 pt-16 max-h-screen overflow-auto">
        <div class="px-6 py-8 bg-cover">
            <div class="text-center font-bold text-black">
                Единицы измерения
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
                        <table v-if="units" class="w-full text-sm text-left text-blue-100 dark:text-blue-100">
                            <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white sticky top-0">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    №
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Наименование единиц измерения
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Удаление
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="unit in units" class="bg-blue-500 border-b border-blue-400">
                                <td class="px-6">
                                    {{ unit.id }}
                                </td>
                                <th scope="row"
                                    class="px-6 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100 text-center">
                                    {{ unit.title }}
                                </th>
                                <td class="px-6 text-center">
                                    1111
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div :class="['relative', this.hideUnit ? '' : 'hidden']">
                            <form class="p-4">
                                <div class="flex">
                                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                                        <div>
                                            <label for="title" class="text-amber=200 mb-2">Наименование единиц
                                                измерения</label>
                                            <input v-model="title" type="text" id="title"
                                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                   placeholder="Наименование единиц измерения" required>
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
            delId: null,
            delTitle: '',
        }
    },

    props: [
        'units',
    ],

    methods: {
        addUnit() {
            this.$inertia.post('/admin/specification/units', {
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

        deleteChannel() {
            this.$inertia.delete(route('channel.destroy', this.delId))
            this.delId = null
            this.delTitle = ''
            this.hideDelete = !this.hideDelete
        }
    }
}
</script>

<style scoped>

</style>
