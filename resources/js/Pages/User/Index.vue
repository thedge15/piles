<template>
    <div v-if="bush" class="text-center italic">
        <Link :href="route('openPage')">
            КГС {{ bush.data.title }}
        </Link>
    </div>
    <div class="flex flex-col h-screen">
        <div :class="[$page.props.auth.user['is_admin'] === 1 ? '' : 'hidden']">
            <CreateButton @closeStore="closeStore"></CreateButton>
        </div>
        <div :class="['flex-grow overflow-auto', $page.props.auth.user['is_admin'] === 1 ? '' : 'mt-5']">
            <table class="relative w-full border mb-3 text-xs table-fixed">
                <thead>
                <tr>
                    <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500 w-4">№</th>
                    <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Наименование раздела РД</th>
                    <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">изм.</th>
                    <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Просмотр</th>
                    <th v-if="$page.props.auth.user['is_admin'] === 1"
                        class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Редактирование
                    </th>
                    <th v-if="$page.props.auth.user['is_admin'] === 1"
                        class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Удаление
                    </th>
                </tr>
                </thead>
                <tbody class="divide-y bg-gray-100">
                <tr v-for="(item, index) in projects">
                    <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ index + 1 }}</td>
                    <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                        <div v-if="hideUpdate || !hideUpdate && item.id !== this.updId">
                            {{ item.title }}
                        </div>
                        <div v-if="!hideUpdate && item.id === this.updId">
                            <input v-model="updTitle" id="updPosition" class="h-8 bg-gray-50 border border-gray-600
                            text-gray-900 text-sm italic text-center rounded-lg focus:ring-blue-500 focus:border-blue-500
                            w-full h-4 block text-xs">
                        </div>
                    </td>
                    <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                        <div v-if="hideUpdate || !hideUpdate && item.id !== this.updId">
                            {{ item.change }}
                        </div>
                        <div v-if="!hideUpdate && item.id === this.updId">
                            <input v-model="updChange" id="updPosition" class="h-8 bg-gray-50 border border-gray-600
                            text-gray-900 text-sm italic text-center rounded-lg focus:ring-blue-500 focus:border-blue-500
                            w-full block text-xs">
                        </div>
                    </td>
                    <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                        <Link :href="route('dashboard.materials', item.id)">
                            <ShowButton></ShowButton>
                        </Link>
                    </td>
                    <td v-if="$page.props.auth.user['is_admin'] === 1" :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                        <div v-if="this.hideUpdate && item.id !== this.updId || !this.hideUpdate && item.id !== this.updId">
                            <button v-if="!this.hideUpdate && item.id !== this.updId" @click.prevent="showUpdate(item)" disabled>
                                <UpdateButton :hide-update="hideUpdate"></UpdateButton>
                            </button>
                            <button v-if="this.hideUpdate && item.id !== this.updId" @click.prevent="showUpdate(item)">
                                <UpdateButton :hide-update="hideUpdate"></UpdateButton>
                            </button>
                        </div>
                        <div v-if="!this.hideUpdate && item.id === this.updId" class="flex justify-center">
                            <svg @click.prevent="updateProject('project')" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-6 h-6 cursor-pointer">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                            </svg>
                            <svg @click.prevent="closeUpdate" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                    </td>
                    <td v-if="$page.props.auth.user['is_admin'] === 1"
                        :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                        <DeleteButton @showDelete="showDelete" :item="item"></DeleteButton>
                    </td>
                </tr>
                </tbody>
            </table>
            <StoreComponent :hide-material="this.hideMaterial" :element="'project'" :element-title="'раздела'"
                            :bush_id="this.bush.data.id" @closeStore="closeStore"></StoreComponent>
            <DeleteComponent :del-element="this.delElement" :hide-delete="this.hideDelete" :del-title="'project'"
                            @closeDelete="closeDelete"></DeleteComponent>
        </div>
    </div>
</template>

<script>

import {Link, router} from "@inertiajs/vue3";
import UserLayout from "@/Layouts/UserLayout.vue";
import StoreComponent from "@/Components/StoreComponent.vue";
import DeleteComponent from "@/Components/DeleteComponent.vue";
import CreateButton from "@/Components/CreateButton.vue";
import ShowButton from "@/Components/ShowButton.vue";
import DeleteButton from "@/Components/DeleteButton.vue";
import mixin from "@/mixins/mixin";
import UpdateButton from "@/Components/UpdateButton.vue";
import UpdateComponent from "@/Components/UpdateComponent.vue";

export default {

    name: "Index",

    layout: UserLayout,

    components: {
        UpdateComponent,
        UpdateButton,
        ShowButton,
        DeleteButton,
        CreateButton,
        StoreComponent,
        DeleteComponent,
        Link
    },

    props: [
        'projects',
        'bush',
    ],

    mixins: [
        mixin
    ],

}
</script>

<style scoped>

</style>
