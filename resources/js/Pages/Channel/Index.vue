<template>
    <main class="ml-60 pt-16 max-h-screen overflow-auto">
        <div class="px-6 py-8 bg-channel-pattern bg-cover">
            <div class="text-center font-bold text-white">
                ШВЕЛЛЕР
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
                <button @click.prevent="this.hideMaterial = !hideMaterial" type="button"
                        class="mb-4 text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600
                        hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300
                        dark:focus:ring-teal-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    Создать
                </button>
                <div :class="['relative overflow-x-auto shadow-md sm:rounded-lg', this.hideMaterial ? '' : 'hidden']">
                    <form class="p-4">
                        <div class="grid gap-6 mb-6 md:grid-cols-4">
                            <div>
                                <label for="title" class="text-white">Наименование швеллера</label>
                                <input v-model="title" type="text" id="title"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="Наименование швеллера" required>
                            </div>
                            <div>
                                <label for="size" class="text-amber=200">Размер швеллера</label>
                                <input v-model="size" type="text" id="size"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="Размер швеллера" required>
                            </div>
                            <div>
                                <label for="tonLength" class="text-white">Длина тонны металлопроката</label>
                                <input v-model="tonLength" type="number" step="0.01" id="tonLength"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="Длина тонны металлопроката" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"
                                       required>
                            </div>
                            <div>
                                <label for="tonArea" class="text-white">Площадь тонны металлопроката</label>
                                <input v-model="tonArea" type="number" step="0.01" id="tonArea"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="Площадь тонны металлопроката" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"
                                       required>
                            </div>
                        </div>
                        <button @click.prevent="addChannel" type="button"
                                class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500
                                hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300
                                dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                            Добавить
                        </button>
                    </form>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4 bg-lime-50">
                    <div class="table-wrp block max-h-96">
                        <table v-if="channels" class="w-full text-sm text-left text-blue-100 dark:text-blue-100">
                            <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white sticky top-0">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    №
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Наименование швеллера
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Просмотр
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
                            <tr v-for="channel in channels" class="bg-blue-500 border-b border-blue-400">
                                <td class="px-6">
                                    {{ channel.data.id }}
                                </td>
                                <th scope="row"
                                    class="px-6 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100 text-center">
                                    {{ channel.data.title }}
                                </th>
                                <td class="px-6">
                                    <Link :href="route('channel.show', channel.data.id)">
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
                                <td class="px-6">
                                    <svg @click.prevent="showUpdate(channel.data.id, channel.data.title, channel.data.size, channel.data.ton_length, channel.data.ton_area)"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor" class="w-6 h-6 mx-auto cursor-pointer">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                    </svg>
                                </td>
                                <td class="px-6">
                                    <svg @click.prevent="showDelete(channel.data.id, channel.data.title)"
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
                    </div>
                </div>
            </div>
        </div>
        <div :class="['relative overflow-x-auto shadow-md sm:rounded-lg', this.hideUpdate ? '' : 'hidden']">
            <form class="p-4">
                <div class="grid gap-6 mb-6 md:grid-cols-4">
                    <div>
                        <label for="title" class="text-orange-600">Наименование швеллера</label>
                        <input v-model="updateTitle" type="text" id="title"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Наименование швеллера" required>
                    </div>
                    <div>
                        <label for="size" class="text-orange-600">Размер швеллера</label>
                        <input v-model="updateSize" type="number" id="size"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Размер швеллера" required>
                    </div>
                    <div>
                        <label for="tonLength" class="text-orange-600">Длина тонны металлопроката</label>
                        <input v-model="updateTonLength" type="number" step="0.01" id="tonLength"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Длина тонны металлопроката" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"
                               required>
                    </div>
                    <div>
                        <label for="tonArea" class="text-orange-600">Площадь тонны металлопроката</label>
                        <input v-model="updateTonArea" type="number" step="0.01" id="tonArea"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Площадь тонны металлопроката" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"
                               required>
                    </div>
                </div>
                <button @click.prevent="updateChannel" type="button"
                        class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500
                                hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300
                                dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    Обновить
                </button>
                <button @click.prevent="this.hideUpdate = !this.hideUpdate" type="button"
                        class="text-white bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    Отмена
                </button>
            </form>
        </div>
        <div :class="['ml-6 mt-3', hideDelete ? '' : 'hidden']">
            <h1 class="italic mb-3">Удалить {{ this.delTitle }}?</h1>
            <div class="flex">
                <button @click.prevent="deleteChannel" type="button"
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

    layout: AdminLayout,

    components: {
        Link
    },

    data() {
        return {
            hideDelete: false,
            hideMaterial: false,
            hideUpdate: false,
            title: '',
            size: null,
            tonLength: null,
            tonArea: null,
            delId: null,
            delTitle: '',
            updateId: null,
            updateTitle: '',
            updateSize: null,
            updateTonLength: null,
            updateTonArea: null,
        }
    },
    //
    // mounted() {
    //     this.showAnything()
    // },
    //
    props: [
        'channels',
    ],

    methods: {
        //
        // showAnything() {
        //     console.log(this.channels);
        // },

        addChannel() {
            this.$inertia.post('/admin/channels', {
                title: this.title,
                ton_length: this.tonLength,
                ton_area: this.tonArea,
                size: this.size,
            })
            this.title = ''
            this.tonLength = null
            this.tonArea = null
            this.hideMaterial = !this.hideMaterial
        },

        showUpdate(id, title, size, tonLength, tonArea)
        {
            this.hideUpdate = !this.hideUpdate
            this.updateId = id
            this.updateSize = size
            this.updateTitle = title
            this.updateTonLength = tonLength
            this.updateTonArea = tonArea
        },

        updateChannel() {
            this.$inertia.patch(route('channel.update', this.updateId), {
                title: this.updateTitle,
                size: this.updateSize,
                ton_length: this.updateTonLength,
                ton_area: this.updateTonArea,
            })
            this.hideUpdate = !this.hideUpdate
            this.updateSize = null
            this.updateTitle = ''
            this.updateTonLength = null
            this.updateTonArea = null
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
