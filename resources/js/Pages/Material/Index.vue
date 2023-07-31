<template>
    <div v-if="project" class="text-center italic">
        <Link :href="route('user.index', project.data.bush_id)">
            {{ project.data.title }}
        </Link>
    </div>
    <CreateButton @closeStore="closeStore"></CreateButton>
    <!-- component -->
    <div class="flex-grow overflow-auto">
        <table class="relative w-full border mb-3 text-xs">
            <thead>
            <tr>
                <th class="sticky top-0 px-2 py-2 text-indigo-100 bg-indigo-500"><input type="checkbox" v-model="selectAll">
                </th>
                <th class="sticky top-0 px-2 py-2 text-indigo-100 bg-indigo-500">Номер по РФ</th>
                <th class="sticky top-0 px-3 py-2 text-indigo-100 bg-indigo-500">Конструктивный элемент</th>
                <th class="sticky top-0 px-6 py-2 text-indigo-100 bg-indigo-500">Наименование и техническая
                    характеристика
                </th>
                <th class="sticky top-0 px-2 py-2 text-indigo-100 bg-indigo-500">Количество</th>
                <th class="sticky top-0 px-2 py-2 bg-indigo-500">
                    <div class="flex">
                        <select v-model="selectedPaint" id="selectedPaint"
                                class="bg-indigo-500 text-indigo-100 text-sm text-center focus:ring-blue-500 focus:border-indigo-100
                                block">
                            <option :class="[this.selectedPaint === 'Краска' ? 'hidden' : '']">Краска</option>
                            <option selected>{{ this.selectedPaint }}</option>
                            <option :class="['text-sm', this.selectedPaint === item.title ? 'hidden' : '']"
                                    v-for="item in paints">{{ item.title }}
                            </option>
                        </select>
                        <select v-model="selectedColor" id="selectedPaint"
                                class="bg-indigo-500 text-indigo-100 text-sm focus:ring-blue-500 focus:border-indigo-100 text-center block">
                            <option :class="[this.selectedColor === 'Цвет' ? 'hidden' : '']">Цвет</option>
                            <option selected>{{ this.selectedColor }}</option>
                            <option class="bg-gray-400">RAL 7004</option>
                            <option class="bg-yellow-400">RAL 1021</option>
                            <option class="bg-sky-500">RAL 5015</option>
                            <option class="bg-amber-900">RAL 8002</option>
                        </select>
                    </div>
                </th>
                <th class="sticky top-0 px-2 py-2 text-indigo-100 bg-indigo-500">Редактирование</th>
                <th class="sticky top-0 px-2 py-2 text-indigo-100 bg-indigo-500">Удаление</th>
            </tr>
            </thead>
            <tbody class="divide-y bg-gray-100">
            <tr v-for="(item, index) in this.selectedPaintArray">
                <td :class='["px-2 py-1 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <input type="checkbox" :value="item.id" v-model="checkedMaterials">
                    <span class="hidden">{{ item.id }}</span>
                </td>
                <td :class='["px-2 py-1 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ item.numb }}</td>
                <td :class='["px-3 py-1 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ item.element }}</td>
                <td :class='["px-6 py-1 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ item.title }}</td>
                <td :class='["px-2 py-1 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    {{ item.weight }} т <span v-if="item.quantity">({{ Math.floor(item.quantity) }}
                        шт.)</span></td>
                <td :class='["px-2 py-1 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <div v-if="item.paint_color === 'RAL 1021'" class="bg-yellow-400">
                        {{ item.paint }} - {{ item.paint_quantity }} кг
                    </div>
                    <div v-if="item.paint_color === 'RAL 8002'" class="bg-amber-900 text-indigo-100">
                        {{ item.paint }} - {{ item.paint_quantity }} кг
                    </div>
                    <div v-if="item.paint_color === 'RAL 5015'" class="bg-sky-500 text-indigo-100">
                        {{ item.paint }} - {{ item.paint_quantity }} кг
                    </div>
                    <div v-if="item.paint_color === 'RAL 7004'" class="bg-gray-500 text-indigo-100">
                        {{ item.paint }} - {{ item.paint_quantity }} кг
                    </div>
                </td>
                <td :class='["px-2 py-1 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <UpdateButton @showUpdate="showUpdate" :item="item"></UpdateButton>
                </td>
                <td :class='["px-2 py-1 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <DeleteButton @showDelete="showDelete" :item="item"></DeleteButton>
                </td>
            </tr>
            </tbody>
            <tr class="relative sticky bottom-0">
                <td class="text-center text-indigo-100 bg-indigo-500"></td>
                <td class="text-center text-indigo-100 bg-indigo-500"></td>
                <td class="text-center text-indigo-100 bg-indigo-500"></td>
                <td class="text-indigo-100 bg-indigo-500">ИТОГО</td>
                <td class="text-center text-indigo-100 bg-indigo-500">{{ selectedMaterialWeight.toFixed(2) }}т</td>
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
        :units="this.units"
        @closeStore="closeStore"></MaterialStoreComponent>
    <DeleteComponent :del-element="this.delMaterial" :hide-delete="this.hideDelete" :del-title="'material'"
                     @closeDelete="closeDelete"></DeleteComponent>
    <MaterialUpdateComponent :hide-update="this.hideUpdate" :upd-material="this.updMaterial" :elements="this.elements"
        :paints="this.paints" @closeUpdate="closeUpdate"></MaterialUpdateComponent>
        <Link :href="route('export', this.project.data.id)" class="font-bold text-sm ml-2">Экспорт</Link>
<!--                    <Link :href="route('all')">-->
<!--                        Набивка материала-->
<!--                    </Link>-->



</template>

<script>


import UserLayout from "@/Layouts/UserLayout.vue";
import {Link} from "@inertiajs/vue3";
import DeleteComponent from "@/Components/DeleteComponent.vue";
import MaterialStoreComponent from "@/Components/MaterialStoreComponent.vue";
import MaterialUpdateComponent from "@/Components/MaterialUpdateComponent.vue";
import CreateButton from "@/Components/CreateButton.vue";
import DeleteButton from "@/Components/DeleteButton.vue";
import UpdateButton from "@/Components/UpdateButton.vue";


export default {

    name: "Index",

    data() {
        return {
            hideMaterial: false,
            hideUpdate: false,
            hideDelete: false,
            updMaterial: null,
            delMaterial: null,
            errors: Object,
            selectedPaint: 'Краска',
            selectedColor: 'Цвет',
            checkedMaterials: [],
        }
    },

    layout: UserLayout,




    components: {
        UpdateButton,
        DeleteButton,
        MaterialUpdateComponent,
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
        'message'
    ],

    computed: {
        allSelectedMaterials() {
            return this.materials.filter((material) => this.checkedMaterials.includes(material.id))
        },

        selectedMaterialWeight() {
            const materialWeight = this.allSelectedMaterials.map((material) => material.weight)
            return materialWeight.reduce(function (a, b) {
                return Number(a) + Number(b);
            }, 0);
        },

        selectedMaterialPaint() {
            const materialPaint = this.allSelectedMaterials.map((material) => material.paint_quantity)
            return materialPaint.reduce(function (a, b) {
                return Number(a) + Number(b);
            }, 0);
        },

        selectAll: {
            get: function () {
                return this.selectedPaintArray ? this.checkedMaterials.length === this.selectedPaintArray.length : false;
            },
            set: function (value) {
                const selected = [];

                if (value) {
                    this.selectedPaintArray.forEach(function (material) {
                        selected.push(material.id);
                    });
                }

                this.checkedMaterials = selected;
            }
        },

        // uniqueSelectedQuantity() {
        //     return [...new Set(this.selectedMaterialQuantity)]
        // }

        selectedPaintArray() {
            if (this.selectedPaint === "Краска" && this.selectedColor === "Цвет") {
                return this.materials;
            }

            if (this.selectedPaint !== "Краска" && this.selectedColor === "Цвет") {
                return this.materials.filter(item => item.paint === this.selectedPaint);
            }

            if (this.selectedPaint === "Краска" && this.selectedColor !== "Цвет") {
                return this.materials.filter(item => item.paint_color === this.selectedColor);
            }

            if (this.selectedPaint !== "Краска" && this.selectedColor !== "Цвет") {
                return this.materials.filter(item => item.paint === this.selectedPaint).filter(item => item.paint_color === this.selectedColor);
            }
        }
    },

    methods: {

        hhy() {

        },

        closeStore() {
            this.hideMaterial = !this.hideMaterial
        },

        showDelete(item) {
            this.hideDelete = !this.hideDelete
            this.delMaterial = item
        },

        showUpdate(item) {
            this.hideUpdate = !this.hideUpdate
            this.updMaterial = item
        },

        closeUpdate() {
            this.hideUpdate = !this.hideUpdate
        },

        closeDelete() {
            this.delMaterial = ''
            this.hideDelete = !this.hideDelete
        },


    },
}

</script>

<style scoped>

</style>
