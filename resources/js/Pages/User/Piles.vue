`<template>
    <main class="py-4 max-h-screen overflow-auto bg-gradient-to-r from-amber-100 to-amber-50">
        <div class="px-6">
            <div class="text-center font-bold">
                ВСЕ СВАИ
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="table-wrp block max-h-96">
                    <table v-if="piles" class="w-full text-sm text-left text-blue-100 dark:text-blue-100">
                        <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white sticky top-0">
                        <tr>
                            <th scope="col" class="py-3 text-center">
                                №
                            </th>
                            <th scope="col" class="py-3 px-2 text-center">
                                <input type="checkbox" v-model="selectAll">
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Раздел РД
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Наименование сваи
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Труба
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Длина сваи
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Высотная отметка
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="pile in piles.data" class="bg-blue-500 border-b border-blue-400">
                            <td class="text-center">
                                {{ pile.id }}
                            </td>
                            <td class="px-2 text-center">
                                <input type="checkbox" :value="pile.id" v-model="checkedMaterials">
                            </td>
                            <th scope="row"
                                class="px-6 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100 text-center">
                                {{ pile.project.title }}
                            </th>
                            <th scope="row"
                                class="px-6 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100 text-center">
                                {{ pile.title }}
                            </th>
                            <th scope="row"
                                class="px-6 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100 text-center">
                                {{ pile.tube }}
                            </th>
                            <th scope="row"
                                class="px-6 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100 text-center">
                                {{ pile.length }}
                            </th>
                            <th scope="row"
                                class="px-6 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100 text-center">
                                {{ pile.altitude_mark }}
                            </th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <button @click.prevent="calculateConcrete" type="button"
                    class="ml-6 mt-3 text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-3">
                Рассчитать бетон
            </button>
            <button @click.prevent="exportPiles" type="button"
                    class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                Экспорт
            </button>
        </div>
    </main>
</template>

<script>

import {Link} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

export default {

    name: "Index",

    data() {
        return {
            project: this.project,
            hidePile: false,
            hideUpd: false,
            hideDelete: false,
            project_id: null,
            title: '',
            tube: '',
            length: null,
            altitude_mark: null,
            quantity: 1,
            checkedMaterials: [],
        }
    },

    layout: AuthenticatedLayout,

    components: {
        Link
    },

    methods: {

        calculateConcrete() {
            this.$inertia.post('/admin/piles/calculate', {checkedMaterials: this.checkedMaterials})
            this.checkedMaterials = []
        },

        exportPiles() {
            this.$inertia.get('/piles/export')
        }
    },

    props: [
        'piles',
        'project',
        'tubes',
        'concreteQuantity'
    ],

    computed: {
        selectAll: {
            get: function () {
                return this.piles.data ? this.checkedMaterials.length === this.piles.data.length : false;
            },


            set: function (value) {
                let selected = [];

                if (value) {
                    this.piles.data.forEach(function (pile) {
                        selected.push(pile.id);
                    });
                }

                this.checkedMaterials = selected
            }
        }
    },
}
</script>

<style scoped>

</style>
