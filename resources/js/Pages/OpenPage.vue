<template>
    <div class="flex flex-col h-screen py-5">
        <p class="text-center italic">КГС</p>
        <div class="mt-4">
            <button v-if="$page.props.auth.user.is_admin === 1" @click.prevent="hideBush = !hideBush" type="button"
                    class="w-1/12 mb-2 text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2">
                Создать
            </button>
            <!-- component -->
            <div class="flex-grow overflow-auto">
                <table class="relative w-full border mb-3">
                    <thead>
                    <tr>
                        <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">№</th>
                        <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Наименование куста</th>
                        <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Просмотр</th>
                        <th v-if="$page.props.auth.user.is_admin === 1"
                            class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Удаление
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y bg-gray-100">
                    <tr v-for="(bush, index) in bushes">
                        <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{
                                index + 1
                            }}
                        </td>
                        <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{
                                bush.title
                            }}
                        </td>
                        <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                            <Link :href="route('user.index', bush.id)">
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
                            <svg @click.prevent="showDelete(bush)" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto cursor-pointer">
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
            <StoreComponent :hide-material="this.hideBush" :element="'bush'" :element-title="'куста'" @closeStore="closeStore"></StoreComponent>
            <DeleteComponent :del-element="this.delBush" :hide-delete="this.hideDelete" :del-title="'bush'"  @closeDelete="closeDelete"></DeleteComponent>
            </div>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import UserLayout from "@/Layouts/UserLayout.vue";
import DeleteComponent from "@/Components/DeleteComponent.vue";
import StoreComponent from "@/Components/StoreComponent.vue";


export default {

    name: "OpenPage",

    layout: UserLayout,

    data() {
        return {
            bush: this.bush,
            hideBush: false,
            title: '',
            hideDelete: false,
            delBush: '',
        }
    },

    components: {
        StoreComponent,
        DeleteComponent,
        Link
    },

    props: [
        'bushes',
    ],

    methods: {
        closeStore() {
            this.hideBush = !this.hideBush
        },

        showDelete(bush) {
            this.hideDelete = !this.hideDelete
            this.delBush = bush
        },

        closeDelete() {
            this.delBush = ''
            this.hideDelete = !this.hideDelete
        },
    },



}
</script>

<style scoped>

</style>

