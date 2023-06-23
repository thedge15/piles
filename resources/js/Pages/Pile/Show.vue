<template>
    <main class="ml-60 pt-16 max-h-screen overflow-auto">
        <div class="px-6 py-8">
            <div v-if="project" class="text-center font-bold">
                <Link :href="route('bush.show', project.data.bush_id)">
                    {{ project.data.title }}
                </Link>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
                <button @click.prevent="hidePile = !hidePile" type="button"
                        class="mb-12 text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
                        value="создать">
                    Создать
                </button>
                <div :class="['relative overflow-x-auto shadow-md sm:rounded-lg', this.hidePile ? '' : 'hidden']">
                    <form class="p-4">
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label for="pile_title"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Наименование
                                    сваи</label>
                                <input v-model="title" type="text" id="pile_title"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="Свая" required>
                            </div>
                            <div>
                                <label for="tube"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Выбор
                                    трубы</label>
                                <select id="tube" v-model="tube"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option v-for="item in tubes.data" :value="item.title">{{ item.title }}</option>
                                </select>
                            </div>
                            <div>
                                <label for="pile_length"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Длина
                                    сваи</label>
                                <input v-model="length" type="number" id="pile_length"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="" required>
                            </div>
                            <div>
                                <label for="altitude_mark"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Высотная
                                    отметка</label>
                                <input v-model="altitude_mark" type="number" id="altitude_mark"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="" required>
                            </div>
                            <div>
                                <label for="quantity"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Количество</label>
                                <input v-model="quantity" type="number" id="quantity"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="" required>
                            </div>
                        </div>
                        <button @click.prevent="addPile" type="button"
                                class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                            Добавить
                        </button>
                    </form>
                </div>
                <div class="table-wrp block max-h-96">
                    <table v-if="piles" class="w-full text-sm text-left text-blue-100 dark:text-blue-100 my-2">
                        <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white sticky top-0">
                        <tr>
                            <th scope="col" class="py-3 text-center">
                                №
                            </th>
                            <th scope="col" class="py-3 px-2 text-center">
                                <input type="checkbox" v-model="selectAll">
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
                            <th scope="col" class="px-6 py-3 text-center">
                                Редактирование
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Удаление
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
                            <td class="px-6">
                                <svg
                                    @click.prevent="showUpdate(pile.id, pile.title, pile.tube, pile.length, pile.altitude_mark)"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6 mx-auto cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                </svg>
                            </td>
                            <td class="px-6">
                                <svg @click.prevent="showDelete(pile.id, pile.title)" xmlns="http://www.w3.org/2000/svg"
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
                </div>
            </div>
            <button @click.prevent="calculateConcrete" type="button"
                    class="ml-6 mt-3 text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-3">
                Рассчитать бетон
            </button>
        </div>
        <form :class="['p-4', this.hideUpd ? '' : 'hidden' ]">
            <div class="grid gap-6 mb-6 md:grid-cols-4">
                <div v-if="updTitle">
                    <input v-model="updTitle" type="text"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           required>
                </div>
                <div>
                    <input v-model="updTube" type="text"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           required>
                </div>
                <div>
                    <input v-model="updLength" type="number" id="pile_length"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           required>
                </div>
                <div>
                    <input v-model="updAltitudeMark" type="number" id="altitude_mark"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="Высотная отметка" required>
                </div>
            </div>
            <div class="flex">
                <button @click.prevent="updatePile" type="button"
                        class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    Обновить
                </button>
                <button @click.prevent="this.hideUpd = !this.hideUpd" type="button"
                        class="text-white bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    Отмена
                </button>
            </div>
        </form>
        <div :class="['ml-6', hideDelete ? '' : 'hidden']">
            <h1 class="italic mb-3">Удалить сваю № {{ this.delId }} {{ this.delTitle }}?</h1>
            <div class="flex">
                <button @click.prevent="deletePile" type="button"
                        class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    Удалить
                </button>
                <button @click.prevent="this.hideDelete = !this.hideDelete" type="button"
                        class="text-white bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    Отмена
                </button>
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
            updId: null,
            updTitle: '',
            updTube: '',
            updLength: null,
            updAltitudeMark: null,
            delId: null,
            delTitle: '',
        }
    },

    layout: AdminLayout,

    components: {
        Link
    },

    methods: {
        addPile() {
            this.$inertia.post('/admin/piles', {
                project_id: this.project.data.id,
                title: this.title,
                tube: this.tube,
                length: this.length,
                altitude_mark: this.altitude_mark,
                quantity: this.quantity,
            })
            this.hidePile = !this.hidePile
            this.title = ''
            this.tube = ''
            this.length = null
            this.altitude_mark = null
            this.quantity = 1
        },


        calculateConcrete() {
            this.$inertia.post('/admin/piles/calculate', {checkedMaterials: this.checkedMaterials})
            this.checkedMaterials = []
        },

        showUpdate(id, title, tube, length, altitude_mark) {
            this.updId = id
            this.hideUpd = !this.hideUpd
            this.updTitle = title
            this.updTube = tube
            this.updLength = length
            this.updAltitudeMark = altitude_mark
        },

        updatePile() {
            this.$inertia.patch('/admin/piles/' + this.updId, {
                title: this.updTitle,
                tube: this.updTube,
                length: this.updLength,
                altitude_mark: this.updAltitudeMark,
            })
            this.hideUpd = !this.hideUpd
            this.updId = null
            this.updTitle = ''
            this.updTube = ''
            this.updLength = null
            this.updAltitudeMark = null
        },

        showDelete(id, title) {
            this.hideDelete = !this.hideDelete
            this.delId = id
            this.delTitle = title
        },

        deletePile() {
            this.$inertia.delete(route('pile.destroy', this.delId))
            this.delId = null
            this.delTitle = ''
            this.hideDelete = !this.hideDelete
        },
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
