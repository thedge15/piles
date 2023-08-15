<template>
    <Link :href="route('metal.index')" class="text-center italic">{{ metal.data.title }}</Link>
    <CreateButton @closeStore="closeStore"></CreateButton>
    <div class="flex-grow overflow-auto">
        <table v-if="metals" class="relative w-full border mb-3 table-fixed">
            <thead>
            <tr>
                <th class="sticky top-0 px-2 py-3 text-indigo-100 text-left w-6 bg-indigo-500">№</th>
                <th class="sticky top-0 px-2 py-3 text-indigo-100 bg-indigo-500">Наименование</th>
                <th class="sticky top-0 px-2 py-3 text-indigo-100 bg-indigo-500">Размеры</th>
                <th v-if="metal.data.title !== 'Лист' && metal.data.title !== 'Лист просечно-вытяжной' && metal.data.title !== 'Лист рулонный'"
                    class="sticky top-0 px-2 py-3 text-indigo-100 bg-indigo-500">Длина тонны, м
                </th>
                <th class="sticky top-0 px-2 py-3 text-indigo-100 bg-indigo-500">Площадь тонны, м<sup>2</sup></th>
                <th class="sticky top-0 px-2 py-3 text-indigo-100 bg-indigo-500">Редактирование</th>
                <th class="sticky top-0 px-2 py-3 text-indigo-100 bg-indigo-500">Удаление</th>
            </tr>
            </thead>
            <tbody class="divide-y bg-gray-100">
            <tr v-for="(item, index) in metals">
                <td :class='["px-2 py-2 text-left", index%2 === 0 ? "" : "bg-gray-300"]'>{{ index + 1 }}</td>
                <td :class='["px-2 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    {{ item.metal.data.title }}
                </td>
                <td :class='["px-2 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <div v-if="hideUpdate || !hideUpdate && item.id !== this.updId">
                        {{ item.title }}
                    </div>
                    <div v-if="!hideUpdate && item.id === this.updId">
                        <input v-model="updTitle" id="updPosition" class="h-8 bg-gray-50 border border-gray-600
                            text-gray-900 text-sm italic text-center rounded-lg focus:ring-blue-500 focus:border-blue-500
                            w-full block text-xs">
                    </div>
                </td>
                <td v-if="metal.data.title !== 'Лист' && metal.data.title !== 'Лист просечно-вытяжной' && metal.data.title !== 'Лист рулонный'"
                    :class='["px-2 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <div v-if="hideUpdate || !hideUpdate && item.id !== this.updId">
                        {{ item.ton_length }}
                    </div>
                    <div v-if="!hideUpdate && item.id === this.updId">
                        <input v-model="updTonLength" id="updPosition" class="h-8 bg-gray-50 border border-gray-600
                            text-gray-900 text-sm italic text-center rounded-lg focus:ring-blue-500 focus:border-blue-500
                            w-full block text-xs">
                    </div>
                </td>
                <td :class='["px-2 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <div v-if="hideUpdate || !hideUpdate && item.id !== this.updId">
                        {{ item.ton_area }}
                    </div>
                    <div v-if="!hideUpdate && item.id === this.updId">
                        <input v-model="updTonArea" id="updPosition" class="h-8 bg-gray-50 border border-gray-600
                            text-gray-900 text-sm italic text-center rounded-lg focus:ring-blue-500 focus:border-blue-500
                            w-full block text-xs">
                    </div>
                </td>
                <td :class='["px-2 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <div v-if="this.hideUpdate && item.id !== this.updId || !this.hideUpdate && item.id !== this.updId">
                        <button v-if="!this.hideUpdate && item.id !== this.updId" @click.prevent="showUpdate(item)" disabled>
                            <UpdateButton :hide-update="hideUpdate"></UpdateButton>
                        </button>
                        <button v-if="this.hideUpdate && item.id !== this.updId" @click.prevent="showUpdate(item)">
                            <UpdateButton :hide-update="hideUpdate"></UpdateButton>
                        </button>
                    </div>
                    <div v-if="!this.hideUpdate && item.id === this.updId" class="flex justify-center">
                        <svg @click.prevent="updateProject('characteristic')" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-6 h-6 cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                        </svg>
                        <svg @click.prevent="closeUpdate" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                </td>
                <td :class='["px-2 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <DeleteButton @showDelete="showDelete" :item="item"></DeleteButton>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <MetalStoreComponent :hide-product="this.hideMaterial" :metal="this.metal"
                         @closeStore="closeStore"></MetalStoreComponent>
    <DeleteComponent :hide-delete="this.hideDelete" :del-element="this.delElement" :del-title="'characteristic'"
                     @closeDelete="closeDelete"></DeleteComponent>
</template>

<script>

import {Link} from "@inertiajs/vue3";
import UserLayout from "@/Layouts/UserLayout.vue";
import DeleteComponent from "@/Components/DeleteComponent.vue";
import MetalStoreComponent from "@/Components/MetalStoreComponent.vue";
import CreateButton from "@/Components/CreateButton.vue";
import DeleteButton from "@/Components/DeleteButton.vue";
import mixin from "@/mixins/mixin";
import UpdateComponent from "@/Components/UpdateComponent.vue";
import UpdateButton from "@/Components/UpdateButton.vue";

export default {

    name: "Index",

    layout: UserLayout,

    components: {
        UpdateButton,
        UpdateComponent,
        DeleteButton,
        CreateButton,
        DeleteComponent,
        MetalStoreComponent,
        Link
    },

    props: [
        'metals',
        'metal',
    ],

    mixins: [
        mixin
    ],
}
</script>
