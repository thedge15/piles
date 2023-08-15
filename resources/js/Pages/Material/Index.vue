<template>
    <div v-if="project" class="text-center italic">
        <Link :href="route('user.index', project.data.bush_id)">
            {{ project.data.title }}
        </Link>
    </div>
    <CreateButton @closeStore="closeStore"></CreateButton>
    <!-- component -->
    <div class="flex-grow overflow-auto">
        <table class="relative w-full border mb-3 text-xs table-fixed">
            <thead>
            <tr>
                <th class="w-6"><input type="checkbox" v-model="selectAll"></th>
                <th class="w-16">№ РФ</th>
                <th class="w-64">Конструктивный элемент</th>
                <th>Наименование и техническая характеристика</th>
                <th class="w-28">Количество, т</th>
                <th class="w-128">
                    <PaintFilter :paints="paints" :colors="colors" @filterPaint="filterPaint"
                                 @filterColor="filterColor"/>
                </th>
                <th class="w-24">Ред.</th>
                <th class="w-24">Удаление</th>
            </tr>
            </thead>
            <tbody class="divide-y bg-gray-100">
            <tr v-for="(item, index) in this.selectedPaintArray">
                <td :class='["px-2 py-1.5 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <input type="checkbox" :value="item.id" v-model="checkedMaterials">
                    <span class="hidden">{{ item.id }}</span>
                </td>
                <td :class='["px-2 py-1.5 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <div v-if="hideUpdate || !hideUpdate && item.id !== this.updId">
                        {{ item['numb'] }}
                    </div>
                    <div v-if="!hideUpdate && item.id === this.updId">
                        <input v-model="updNumb" id="updPosition" class="h-8 bg-gray-50 border border-gray-600
                            text-gray-900 text-sm italic text-center rounded-lg focus:ring-blue-500 focus:border-blue-500
                            block w-full text-xs">
                    </div>
                </td>
                <td :class='["px-3 py-1.5 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <div v-if="hideUpdate || !hideUpdate && item.id !== this.updId">
                        {{ item.element }}
                    </div>
                    <div v-if="!hideUpdate && item.id === this.updId" class="ml-10">
                        <select v-model="updElement" id="updPosition" class="bg-gray-50 border border-gray-600
                            text-gray-900 text-sm italic text-center rounded-lg focus:ring-blue-500
                            focus:border-blue-500 block w-44 h-8 text-xs">
                            <option v-for="element in elements">{{ element.title }}</option>
                        </select>
                    </div>
                </td>
                <td :class='["px-6 py-1.5 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <div v-if="hideUpdate || !hideUpdate && item.id !== this.updId">
                        {{ item.title }}
                    </div>
                    <div v-if="!hideUpdate && item.id === this.updId">
                        <input v-model="updTitle" id="updPosition" class="h-8 bg-gray-50 border border-gray-600
                            text-gray-900 text-sm italic text-center rounded-lg focus:ring-blue-500 focus:border-blue-500
                            w-full block text-xs">
                    </div>
                </td>
                <td :class='["px-2 py-1.5 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <div v-if="hideUpdate || !hideUpdate && item.id !== this.updId">
                        {{ item.weight }} <span v-if="item.quantity"> ({{ item.quantity }} шт.)</span>
                    </div>
                    <div v-if="!hideUpdate && item.id === this.updId">
                        <input v-model="updWeight" id="updPosition" class="h-8 bg-gray-50 border border-gray-600
                            text-gray-900 text-sm italic text-center rounded-lg focus:ring-blue-500 focus:border-blue-500
                            block w-full text-xs">
                    </div>
                </td>
                <td :class='["px-2 py-1.5 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <div class="ml-2">
                        <div v-if="hideUpdate || !hideUpdate && item.id !== this.updId"
                             :class="[colors[item.paint_color]]">
                            <div class="text-black">{{ item.paint }} {{ item.paint_color }}<span
                                v-if="item.paint_quantity"> - {{ item.paint_quantity }} кг</span></div>
                        </div>
                        <div v-if="!hideUpdate && item.id === this.updId" class="flex flex flex-wrap justify-center">
                            <select v-model="updPaint" id="updPosition" class="bg-gray-50 border border-gray-600
                            text-gray-900 text-sm italic text-center rounded-lg focus:ring-blue-500 focus:border-blue-500
                            block w-48 h-8 text-xs">
                                <option class="text-center" v-for="paint in paints">{{ paint.title }}</option>
                            </select>
                            <select v-model="updPaintColor" id="updPosition" class="bg-gray-50 border border-gray-600
                            text-gray-900 text-sm italic text-center rounded-lg focus:ring-blue-500 focus:border-blue-500
                            block w-28 h-8 text-xs">
                                <option :class="[value]" v-for="(value, color) in colors">{{ color }}</option>
                            </select>
                            <select v-model="updNumberOfLayers" id="updPosition" class="bg-gray-50 border border-gray-600
                                text-gray-900 text-sm italic text-center rounded-lg focus:ring-blue-500 focus:border-blue-500
                                block w-20 h-8 text-xs">
                                <option selected class="text-left">Слои</option>
                                <option class="text-left" v-for="layer in layers">{{ layer }}</option>
                            </select>
                            <div class="flex ml-1 mt-2">
                                <input type="checkbox" id="checkbox" v-model="updIsPile">
                                <label for="checkbox">Свая</label>
                            </div>
                        </div>
                    </div>
                </td>
                <td :class='["px-2 py-1.5 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <div v-if="this.hideUpdate && item.id !== this.updId || !this.hideUpdate && item.id !== this.updId">
                        <button v-if="!this.hideUpdate && item.id !== this.updId" @click.prevent="showUpdate(item)" disabled>
                            <UpdateButton :hide-update="hideUpdate"></UpdateButton>
                        </button>
                        <button v-if="this.hideUpdate && item.id !== this.updId" @click.prevent="showUpdate(item)">
                            <UpdateButton :hide-update="hideUpdate"></UpdateButton>
                        </button>
                    </div>
                    <div v-if="!this.hideUpdate && item.id === this.updId" class="flex justify-center">
                        <svg @click.prevent="updateProduct" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-6 h-6 cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                        </svg>
                        <svg @click.prevent="closeUpdate" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                </td>
                <td :class='["px-2 py-1.5 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <DeleteButton @showDelete="showDelete" :item="item"></DeleteButton>
                </td>
            </tr>
            </tbody>
            <tr class="relative sticky bottom-0">
                <td class="text-center text-indigo-100 bg-indigo-500"></td>
                <td class="text-center text-indigo-100 bg-indigo-500"></td>
                <td class="text-indigo-100 bg-indigo-500">ИТОГО</td>
                <td class="text-center text-indigo-100 bg-indigo-500">{{ selectedMaterialWeight.toFixed(2) }}т</td>
                <td class="text-center text-indigo-100 bg-indigo-500"></td>
                <td class="text-center text-indigo-100 bg-indigo-500">{{ selectedMaterialPaint.toFixed(2) }}кг</td>
                <td class="text-center text-indigo-100 bg-indigo-500"></td>
                <td class="text-center text-indigo-100 bg-indigo-500"></td>
            </tr>
        </table>
    </div>
    <MaterialStoreComponent
        :hide-material="this.hideMaterial" :project_id="this.project.data.id" :elements="this.elements"
        :metals="this.metals"
        :characteristics="this.characteristics" :standards="this.standards" :steels="this.steels"
        :units="this.units" :errors="showErrors"
        @closeStore="closeStore"></MaterialStoreComponent>
    <DeleteComponent :del-element="this.delElement" :hide-delete="this.hideDelete" :del-title="'material'"
                     @closeDelete="closeDelete"></DeleteComponent>
    <!--    <Link :href="route('export', this.project.data.id)" class="font-bold text-sm ml-2">Экспорт</Link>-->
<!--                                <Link :href="route('all')">-->
<!--                                    Набивка материала-->
<!--                                </Link>-->
</template>

<script>


import UserLayout from "@/Layouts/UserLayout.vue";
import {Link} from "@inertiajs/vue3";
import DeleteComponent from "@/Components/DeleteComponent.vue";
import MaterialStoreComponent from "@/Components/MaterialStoreComponent.vue";
import CreateButton from "@/Components/CreateButton.vue";
import DeleteButton from "@/Components/DeleteButton.vue";
import materialMixin from "@/mixins/materialMixin.js";
import PaintFilter from "@/Components/PaintFilter.vue";
import UpdateField from "@/Components/UpdateField.vue";
import UpdateButton from "@/Components/UpdateButton.vue";

export default {
    name: "Index",

    layout: UserLayout,

    computed: {
        showErrors() {
            return this.$page.props.errors
        }
    },

    mixins: [
        materialMixin
    ],

    components: {
        UpdateButton,
        UpdateField,
        PaintFilter,
        DeleteButton,
        CreateButton,
        MaterialStoreComponent,
        DeleteComponent,
        Link
    },

    props: [
        'project',
        'metals',
        'characteristics',
        'standards',
        'steels',
        'units',
        'materials',
        'elements',
        'paints',
        'colors',
    ],
}

</script>
