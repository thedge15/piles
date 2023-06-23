<template>
    <main class="max-h-screen overflow-auto">
        <div class="px-6 py-8">
            <div v-if="bush" class="text-center font-bold">
                <Link :href="route('bush.index')">
                    {{ bush.data.title }}
                </Link>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
                <!--                <Link :href="route('bush.create', bush.data.id)">-->
                <button @click.prevent="hideProject = !hideProject" type="button"
                        class="mb-4 text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    Создать проект
                </button>
                <!--                </Link>-->
                <div :class="['relative overflow-x-auto shadow-md sm:rounded-lg', this.hideProject ? '' : 'hidden']">
                    <form class="p-4">
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label for="company"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Раздел</label>
                                <input v-model="title" type="text"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="Наименование раздела" required>
                            </div>
                            <div>
                                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Изм.</label>
                                <input v-model="change" type="number"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="Изм." pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required>
                            </div>
                        </div>
                        <button @click.prevent="addProject" type="button"
                                class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                            Добавить
                        </button>
                    </form>
                </div>
                <table v-if="projects" class="w-full text-sm text-left text-blue-100 dark:text-blue-100">
                    <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            №
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Наименование раздела РД
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Изм.
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            № куста
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
                    <tr v-for="project in projects.data" class="bg-blue-500 border-b border-blue-400">
                        <td class="px-6">
                            {{ project.id }}
                        </td>
                        <th scope="row"
                            class="px-6 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100 text-center">
                            {{ project.title }}
                        </th>
                        <th scope="row"
                            class="px-6 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100 text-center">
                            {{ project.change }}
                        </th>
                        <th scope="row"
                            class="px-6 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100 text-center">
                            {{ bush.data.title }}
                        </th>
                        <td class="px-6">
                            <Link :href="route('pile.show', project.id)">
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
                            <svg @click.prevent="showProject(project.id, project.change)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6 mx-auto cursor-pointer">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                            </svg>
                        </td>
                        <td class="px-6">
                            <svg @click.prevent="showDelete(project.id, project.title)" xmlns="http://www.w3.org/2000/svg"
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
                <div :class="['flex mt-4', hideUpdProject ? '' : 'hidden']">
                    <input v-model="updChange" type="number"
                           class="w-1/6 mr-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="Изм." pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required>
                    <button @click.prevent="updateProject" type="button"
                            class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        Обновить
                    </button>
                    <button @click.prevent="this.hideUpdProject = !this.hideUpdProject" type="button"
                            class="text-white bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        Отмена
                    </button>
                </div>
                <div :class="['ml-6 mt-5', hideDelete ? '' : 'hidden']">
                    <h1 class="italic mb-3">Удалить раздел РД {{ this.delTitle }}?</h1>
                    <div class="flex">
                        <button @click.prevent="deleteProject" type="button"
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
    </main>
</template>

<script>

import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";
import {data} from "autoprefixer";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

export default {

    name: "Index",

    layout: AuthenticatedLayout,

    components: {
        Link
    },

    data() {
        return {
            project: this.project,
            hideProject: false,
            hideUpdProject: false,
            title: '',
            change: null,
            bush_id: null,
            hideDelete: false,
            updId: null,
            updChange: null,
            delId: null,
            delTitle: '',
        }
    },

    props: [
        'projects',
        'bush',
    ],

    methods: {

        addProject() {
            this.$inertia.post('/admin/bushes/projects', {
                bush_id: this.bush.data.id,
                title: this.title,
                change: this.change
            })
            this.title = ''
            this.change = null
            this.hideProject = !this.hideProject
        },

        showProject(id, change) {
            this.hideUpdProject = !this.hideUpdProject
            this.updId = id
            this.updChange = change
        },

        updateProject() {
            this.$inertia.patch(route('project.update', this.updId), {
                change: this.updChange,
            })
            this.hideUpdProject = !this.hideUpdProject
            this.updChange = null
        },

        showDelete(id, title) {
            this.hideDelete = !this.hideDelete
            this.delId = id
            this.delTitle = title
        },

        deleteProject() {
            this.$inertia.delete(route('project.destroy', this.delId))
            this.delId = null
            this.delTitle = ''
            this.hideDelete = !this.hideDelete
        }
    }

}
</script>

<style scoped>

</style>
