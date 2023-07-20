<template>
    <p class="text-center italic">Сортовой прокат</p>
    <CreateButton @closeStore="closeStore"></CreateButton>
    <!-- component -->
    <div class="flex-grow overflow-auto">
        <table class="relative w-full border mb-3 text-xs">
            <thead>
            <tr>
                <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">№</th>
                <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Наименование металлопроката</th>
                <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Посмотреть металлопрокат</th>
                <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Добавить ГОСТ</th>
                <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Удаление</th>
            </tr>
            </thead>
            <tbody class="divide-y bg-gray-100">
            <tr v-for="(metal, index) in metals.data">
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ index + 1 }}</td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    {{ metal.title }}
                </td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <Link :href="route('metal.show', metal.id)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </Link>
                </td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <svg @click.prevent="showStandard(metal.id)"
                         xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                         class="w-6 h-6 mx-auto cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                    </svg>
                </td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <svg @click.prevent="showDelete(metal)"
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
        <DeleteComponent :del-element="this.delMetal" :hide-delete="this.hideDelete" :del-title="'metal'"
                         @closeDelete="closeDelete"></DeleteComponent>
        <div :class="['relative overflow-x-auto shadow-md sm:rounded-lg', this.hideStandard ? '' : 'hidden']">
            <form class="p-4">
                <p>{{ this.title }}</p>
                <div class="grid gap-6 mb-6 md:grid-cols-5">
                    <div>
                        <label for="mark" class="text-orange-600">ГОСТ</label>
                        <input v-model="updateTitle" type="text" id="mark"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                               placeholder="ГОСТ" required>
                    </div>

                </div>
                <button @click.prevent="addStandard" type="button"
                        class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500
                                hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300
                                font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    Добавить ГОСТ
                </button>
                <button @click.prevent="this.hideStandard = !this.hideStandard" type="button"
                        class="text-white bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    Отмена
                </button>
            </form>
        </div>
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

export default {

    name: "Index",

    layout: UserLayout,

    components: {
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
            hideStandard: false,
            title: '',
            mark: '',
            size: null,
            wall: null,
            tonLength: null,
            tonArea: null,
            delMetal: '',
            updateId: null,
            updateTitle: '',
            updateMark: '',
            updateSize: null,
            updateWall: null,
            updateTonLength: null,
            updateTonArea: null,
        }
    },

    props: [
        'metals',
    ],

    methods: {
        closeStore() {
            this.hideMetal = !this.hideMetal
        },

        showUpdate(metal) {
            this.hideUpdate = !this.hideUpdate
            this.updateId = metal.id
            this.title = metal.title
        },

        showStandard(metal) {
            this.hideStandard = !this.hideStandard
            this.updateId = metal.id
            // this.title = metal.title
        },

        addCharacteristic() {
            this.$inertia.post('/admin/specification/characteristic', {
                metal_id: this.updateId,
                mark: this.updateMark,
                // title: this.updateTitle,
                wall: this.updateWall,
                size: this.updateSize,
                ton_length: this.updateTonLength,
                ton_area: this.updateTonArea,
            })
            this.hideUpdate = !this.hideUpdate
            this.updateMark = null
            this.updateSize = null
            this.updateWall = null
            // this.updateTitle = ''
            this.updateTonLength = null
            this.updateTonArea = null
            this.title = ''
        },

        addStandard() {
            this.$inertia.post('/admin/specification/standard', {
                metal_id: this.updateId,

                title: this.updateTitle,
            })
            this.hideStandard = !this.hideStandard
            this.updateTitle = ''
            this.title = ''
        },

        showDelete(metal) {
            this.hideDelete = !this.hideDelete
            this.delMetal = metal
        },

        closeDelete() {
            this.delElement = ''
            this.hideDelete = !this.hideDelete
        },
    }
}
</script>

<style scoped>

</style>
