<template>
    <p class="text-center italic">Краска</p>
    <CreateButton @closeStore="closeStore"></CreateButton>
    <!-- component -->
    <div class="flex-grow overflow-auto">
        <table class="relative w-full border mb-3">
            <thead>
            <tr>
                <th v-for="columnName in columnHeaders" class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">
                    {{ columnName }}
                </th>
            </tr>
            </thead>
            <tbody class="divide-y bg-gray-100">
            <tr v-for="(item, index) in paints">
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ index + 1 }}</td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ item.title }}</td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ item.consumption }}</td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <DeleteButton @showDelete="showDelete" :item="item"></DeleteButton>
                </td>
            </tr>
            </tbody>
        </table>
        <StoreComponent :hide-material="this.hidePaint" :element="'paint'" :element-title="'краски'"
                        @closeStore="closeStore"></StoreComponent>
        <DeleteComponent :del-element="this.delPaint" :hide-delete="this.hideDelete" :del-title="'paint'"
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
import deleteButton from "@/Components/DeleteButton.vue";

export default {

    name: "Index",
    computed: {
        deleteButton() {
            return deleteButton
        },
        DeleteButton() {
            return DeleteButton
        }
    },

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
            hidePaint: false,
            hideUpdate: false,
            delPaint: '',
            columnHeaders: ['№', 'Наименование краски', 'Расход краски', 'Удаление'],
        }
    },

    props: [
        'paints',
    ],

    methods: {

        closeStore() {
            this.hidePaint = !this.hidePaint
        },

        showDelete(item) {
            this.hideDelete = !this.hideDelete
            this.delPaint = item
        },

        closeDelete() {
            this.delElement = ''
            this.hideDelete = !this.hideDelete
        },
    }
}
</script>
