<template>
    <p class="text-center italic">Конструктивные элементы</p>
    <CreateButton @closeStore="closeStore"></CreateButton>
    <!-- component -->
    <div class="flex-grow overflow-auto">
        <table class="relative w-full border mb-3 text-xs">
            <thead>
            <tr>
                <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">№</th>
                <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Наименование раздела РД</th>
                <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Наименование конструктивного
                    элемента
                </th>
                <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Редактирование</th>
                <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Удаление</th>
            </tr>
            </thead>
            <tbody class="divide-y bg-gray-100">
            <tr v-for="(item, index) in elements">
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ index + 1 }}</td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    {{ item.project.data.title }}
                </td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ item.title }}
                    <span v-if="item.quantity"> - {{ item.quantity }} шт.</span></td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <svg
                        @click.prevent="showUpdate(item)"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mx-auto cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582
                                          16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0
                                          011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75
                                          21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                    </svg>
                </td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <DeleteButton @showDelete="showDelete" :item="item"></DeleteButton>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <StoreComponent :hide-material="hideElement" :projects="projects" :element-title="'элемента'" :element="'element'"
                    @closeStore="closeStore"></StoreComponent>
    <DeleteComponent :del-element="this.delElement" :hide-delete="this.hideDelete" :del-title="'element'"
                     @closeDelete="closeDelete"></DeleteComponent>
</template>

<script>

import UserLayout from "@/Layouts/UserLayout.vue";
import {Link} from "@inertiajs/vue3";
import DeleteComponent from "@/Components/DeleteComponent.vue";
import StoreComponent from "@/Components/StoreComponent.vue";
import CreateButton from "@/Components/CreateButton.vue";
import DeleteButton from "@/Components/DeleteButton.vue";

export default {

    name: "Index",

    layout: UserLayout,

    data() {
        return {
            project: '',
            hideElement: false,
            hideDelete: false,
            delElement: null,
        }
    },


    components: {
        DeleteButton,
        CreateButton,
        StoreComponent,
        DeleteComponent,
        Link
    },

    props: [
        'projects',
        'elements',
    ],

    methods: {

        closeStore() {
            this.hideElement = !this.hideElement
        },

        showDelete(item) {
            this.hideDelete = !this.hideDelete
            this.delElement = item
        },

        closeDelete() {
            this.delElement = ''
            this.hideDelete = !this.hideDelete
        },

    },
}

</script>

<style scoped>

</style>
