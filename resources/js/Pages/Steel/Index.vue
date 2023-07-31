<template>
    <p class="text-center italic">Сталь</p>
    <CreateButton @closeStore="closeStore"></CreateButton>
    <!-- component -->
    <div class="flex-grow overflow-auto">
        <table class="relative w-full border mb-3">
            <thead>
            <tr>
                <th v-for="columnName in columnHeaders" class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">{{ columnName }}</th>
            </tr>
            </thead>
            <tbody class="divide-y bg-gray-100">
            <tr v-for="(item, index) in steels">
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ index + 1 }}</td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    {{ item.title }}
                </td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <svg
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mx-auto cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                    </svg>
                </td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <DeleteButton @showDelete="showDelete" :item="item"></DeleteButton>
                </td>
            </tr>
            </tbody>
        </table>
        <StoreComponent :hide-material="this.hideSteel" :element="'steel'" :element-title="'марки стали'"
                        @closeStore="closeStore"></StoreComponent>
        <DeleteComponent :del-element="this.delSteel" :hide-delete="this.hideDelete" :del-title="'steel'"
                         @closeDelete="closeDelete"></DeleteComponent>
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
            hideDelete: false,
            hideSteel: false,
            hideUpdate: false,
            delSteel: '',
            columnHeaders: ['№', 'Наименование стали', 'Редактирование','Удаление'],
        }
    },

    props: [
        'steels',
    ],

    methods: {

        closeStore() {
            this.hideSteel = !this.hideSteel
        },

        showDelete(item) {
            this.hideDelete = !this.hideDelete
            this.delSteel = item
        },

        closeDelete() {
            this.delSteel = ''
            this.hideDelete = !this.hideDelete
        },
    }
}
</script>

<style scoped>

</style>
