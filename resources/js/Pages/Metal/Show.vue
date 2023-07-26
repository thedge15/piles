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
                <th v-if="metal.data.title !== 'Лист' && metal.data.title !== 'Лист просечно-вытяжной' && metal.data.title !== 'Лист рулонный'"
                    class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Длина тонны, м
                </th>
                <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Площадь тонны, м<sup>2</sup></th>
                <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Редактирование</th>
                <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Удаление</th>
            </tr>
            </thead>
            <tbody class="divide-y bg-gray-100">
            <tr v-for="(product, index) in metals.data">
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ index + 1 }}</td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ product.metal.title }}</td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ product.title }}</td>
                <td v-if="metal.data.title !== 'Лист' && metal.data.title !== 'Лист просечно-вытяжной' && metal.data.title !== 'Лист рулонный'"
                    :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    {{ product.ton_length }}
                </td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    {{ product.ton_area }}
                </td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <svg @click.prevent="this.hideUpdate = !this.hideUpdate; this.updProduct = product"
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
                    <svg @click.prevent="this.hideDelete = !this.hideDelete; this.delProduct = product"
                         xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor"
                         class="w-6 h-6 mx-auto cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788
                                    0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25
                                    0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108
                                    0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0
                                    013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32
                                    0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                    </svg>
                </td>
            </tr>
            </tbody>
        </table>
        <MetalStoreComponent :hide-product="this.hideProduct" :metal="this.metal"
                             @closeStore="closeStore"></MetalStoreComponent>
        <DeleteComponent :hide-delete="this.hideDelete" :del-element="this.delProduct" :del-title="'characteristic'"
                         @closeDelete="closeDelete"></DeleteComponent>
        <UpdateComponent :upd-product="this.updProduct" :hide-update="this.hideUpdate" :element="'characteristic'"
                         @closeUpdate="closeUpdate"></UpdateComponent>
    </div>
</template>

<script>

import {Link} from "@inertiajs/vue3";
import UserLayout from "@/Layouts/UserLayout.vue";
import DeleteComponent from "@/Components/DeleteComponent.vue";
import MetalStoreComponent from "@/Components/MetalStoreComponent.vue";
import CreateButton from "@/Components/CreateButton.vue";
import UpdateComponent from "@/Components/UpdateComponent.vue";

export default {

    name: "Index",

    layout: UserLayout,

    components: {
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
            updTitle: '',
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

        closeDelete() {
            this.delProduct = ''
            this.hideDelete = !this.hideDelete
        },
    }
}
</script>

<style scoped>

</style>
