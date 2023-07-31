<template>
    <p class="text-center italic">Сортовой прокат</p>
    <CreateButton @closeStore="closeStore"></CreateButton>
    <!-- component -->
    <div class="flex-grow overflow-auto">
        <table class="relative w-full border mb-3 text-xs">
            <thead>
            <tr>
                <th v-for="columnName in columnHeaders" class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">{{ columnName }}</th>
            </tr>
            </thead>
            <tbody class="divide-y bg-gray-100">
            <tr v-for="(item, index) in metals">
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ index + 1 }}</td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    {{ item.title }}
                </td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <Link :href="route('metal.show', item.id)">
                        <ShowButton></ShowButton>
                    </Link>
                </td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <DeleteButton @showDelete="showDelete" :item="item"></DeleteButton>
                </td>
            </tr>
            </tbody>
        </table>
        <DeleteComponent :del-element="this.delMetal" :hide-delete="this.hideDelete" :del-title="'metal'"
                         @closeDelete="closeDelete"></DeleteComponent>
        <StoreComponent :hide-material="this.hideMetal" :element="'metal'" :element-title="'металлопроката'"
                        @closeStore="closeStore"></StoreComponent>
    </div>
</template>

<script>

import {Link} from "@inertiajs/vue3";
import UserLayout from "@/Layouts/UserLayout.vue";
import DeleteComponent from "@/Components/DeleteComponent.vue";
import StoreComponent from "@/Components/StoreComponent.vue";
import CreateButton from "@/Components/CreateButton.vue";
import DeleteButton from "@/Components/DeleteButton.vue";
import ShowButton from "@/Components/ShowButton.vue";

export default {

    name: "Index",

    layout: UserLayout,

    components: {
        ShowButton,
        DeleteButton,
        CreateButton,
        StoreComponent,
        DeleteComponent,
        Link
    },

    data() {
        return {
            hideDelete: false,
            hideMetal: false,
            hideUpdate: false,
            delMetal: '',
            columnHeaders: ['№', 'Наименование металлопроката', 'Посмотреть металлопрокат','Удаление'],
        }
    },

    props: [
        'metals',
    ],

    methods: {
        closeStore() {
            this.hideMetal = !this.hideMetal
        },

        showDelete(item) {
            this.hideDelete = !this.hideDelete
            this.delMetal = item
        },

        closeDelete() {
            this.delMetal = ''
            this.hideDelete = !this.hideDelete
        },
    }
}
</script>

<style scoped>

</style>
