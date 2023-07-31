<template>
    <Link :href="route('metal.index')" class="text-center italic">
        {{ metal.data.title }}
    </Link>
    <CreateButton @closeStore="closeStore"></CreateButton>
    <!-- component -->
    <div class="flex-grow overflow-auto">
        <table v-if="metals" class="relative w-full border mb-3 text-xs">
            <thead>
            <tr>
                <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">№</th>
                <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Наименование</th>
                <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Размеры</th>
                <th v-if="metal.title !== 'Лист' && metal.title !== 'Лист просечно-вытяжной' && metal.data.title !== 'Лист рулонный'"
                    class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Длина тонны, м
                </th>
                <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Площадь тонны, м<sup>2</sup></th>
                <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Редактирование</th>
                <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Удаление</th>
            </tr>
            </thead>
            <tbody class="divide-y bg-gray-100">
            <tr v-for="(item, index) in metals">
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ index + 1 }}</td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ item.metal.data.title }}</td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ item.title }}</td>
                <td v-if="metal.data.title !== 'Лист' && metal.data.title !== 'Лист просечно-вытяжной' && metal.data.title !== 'Лист рулонный'"
                    :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    {{ item.ton_length }}
                </td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    {{ item.ton_area }}
                </td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <UpdateButton @showUpdate="showUpdate" :item="item"></UpdateButton>
                </td>

                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <DeleteButton @showDelete="showDelete" :item="item"></DeleteButton>
                </td>
            </tr>
            </tbody>
        </table>
        <MetalStoreComponent :hide-product="this.hideProduct" :metal="this.metal"
                             @closeStore="closeStore"></MetalStoreComponent>
        <UpdateComponent :upd-product="this.updProduct" :hide-update="this.hideUpdate" :element="'characteristic'"
                         @closeUpdate="closeUpdate"></UpdateComponent>
        <DeleteComponent :hide-delete="this.hideDelete" :del-element="this.delProduct" :del-title="'characteristic'"
                         @closeDelete="closeDelete"></DeleteComponent>
    </div>
</template>

<script>

import {Link} from "@inertiajs/vue3";
import UserLayout from "@/Layouts/UserLayout.vue";
import DeleteComponent from "@/Components/DeleteComponent.vue";
import MetalStoreComponent from "@/Components/MetalStoreComponent.vue";
import CreateButton from "@/Components/CreateButton.vue";
import UpdateComponent from "@/Components/UpdateComponent.vue";
import DeleteButton from "@/Components/DeleteButton.vue";
import UpdateButton from "@/Components/UpdateButton.vue";

export default {

    name: "Index",

    layout: UserLayout,

    components: {
        UpdateButton,
        DeleteButton,
        UpdateComponent,
        CreateButton,
        DeleteComponent,
        MetalStoreComponent,
        Link
    },

    data() {
        return {
            hideProduct: false,
            hideDelete: false,
            hideUpdate: false,
            delProduct: '',
            updProduct: '',
        }
    },


    props: [
        'metals',
        'metal',
    ],

    methods: {

        closeStore() {
            this.hideProduct = !this.hideProduct
        },

        closeUpdate() {
            this.hideUpdate = !this.hideUpdate
        },

        showUpdate(item) {
            console.log(item);
            this.hideUpdate = !this.hideUpdate
            this.updProduct = item

        },

        showDelete(item) {
            this.hideDelete = !this.hideDelete
            this.delProduct = item
        },

        closeDelete() {
            this.delProduct = ''
            this.hideDelete = !this.hideDelete
        },
    }
}
</script>

<style scoped>

</style>
