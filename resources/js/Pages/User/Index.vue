<template>
    <div v-if="bush" class="text-center italic">
        <Link :href="route('openPage')">
            КГС {{ bush.data.title }}
        </Link>
    </div>
    <div class="flex flex-col h-screen">
        <div v-if="$page.props.auth.user.is_admin === 1">
            <CreateButton @closeStore="closeStore"></CreateButton>
        </div>
        <!-- component -->
        <div class="flex-grow overflow-auto">
            <table class="relative w-full border mb-3 text-xs">
                <thead>
                <tr>
                    <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">№</th>
                    <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Наименование раздела РД</th>
                    <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Просмотр</th>
                    <th v-if="$page.props.auth.user.is_admin === 1"
                        class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Редактирование
                    </th>
                    <th v-if="$page.props.auth.user.is_admin === 1"
                        class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Удаление
                    </th>
                </tr>
                </thead>
                <tbody class="divide-y bg-gray-100">
                <tr v-for="(item, index) in projects">
                    <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ index + 1 }}</td>
                    <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ item.title }},
                        ИЗМ.{{ item.change }}
                    </td>
                    <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                        <Link :href="route('dashboard.materials', item.id)">
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
                    <td v-if="$page.props.auth.user.is_admin === 1"
                        :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                        <svg @click.prevent="showProject(item.id, item.change)"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6 mx-auto cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                        </svg>
                    </td>
                    <td v-if="$page.props.auth.user.is_admin === 1"
                        :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                        <DeleteButton @showDelete="showDelete" :item="item"></DeleteButton>
                    </td>
                </tr>
                </tbody>
            </table>
            <StoreComponent :hide-material="this.hideProject" :element="'project'" :element-title="'раздела'"
                            :bush_id="this.bush.data.id"
                            @closeStore="closeStore"></StoreComponent>
            <DeleteComponent :del-element="this.delProject" :hide-delete="this.hideDelete" :del-title="'project'"
                             @closeDelete="closeDelete"></DeleteComponent>
            <div :class="['shadow-md sm:rounded-lg', hideUpdProject ? '' : 'hidden']">
                <form class="p-4 bg-gray-200 mt-4">
                    <input v-model="updChange" type="number"
                           class="w-1/6 mr-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2"
                           placeholder="Изм." pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required>
                    <button @click.prevent="updateProject" type="button"
                            class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        Обновить
                    </button>
                    <button @click.prevent="this.hideUpdProject = !this.hideUpdProject" type="button"
                            class="text-white bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        Отмена
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

import {Link} from "@inertiajs/vue3";
import UserLayout from "@/Layouts/UserLayout.vue";
import DeleteComponent from "@/Components/DeleteComponent.vue";
import StoreComponent from "@/Components/StoreComponent.vue";
import CreateButton from "@/Components/CreateButton.vue";
import DeleteButton from "@/Components/DeleteButton.vue";

export default {

    name: "Index",

    layout: UserLayout,

    components: {
        DeleteButton,
        CreateButton,
        StoreComponent,
        DeleteComponent,
        Link
    },

    data() {
        return {
            project: this.project,
            hideProject: false,
            hideUpdProject: false,
            title: '',
            change: null,
            updId: null,
            updChange: null,
            hideDelete: false,
            delProject: '',
        }
    },

    props: [
        'projects',
        'bush',
    ],

    methods: {
        closeStore() {
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

        showDelete(item) {
            this.hideDelete = !this.hideDelete
            this.delProject = item
        },

        closeDelete() {
            this.delProject = ''
            this.hideDelete = !this.hideDelete
        },
    }

}
</script>

<style scoped>

</style>
