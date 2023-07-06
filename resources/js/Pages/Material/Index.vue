<template>
    <div class="flex flex-col h-screen py-5">
        <div v-if="project" class="text-center italic">
            <Link :href="route('user.index', project.data.bush_id)">
                {{ project.data.title }}
            </Link>
        </div>

        <button @click.prevent="this.hideMaterial = !hideMaterial" type="button"
                class="mb-2 mx-6 w-1/12 text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600
                        hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300
                        font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2">
            Создать
        </button>
        <!-- component -->
        <div class="flex-grow overflow-auto">
            <table class="relative w-full border mb-3 text-xs">
                <thead>
                <tr>
                    <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500"><input type="checkbox"
                                                                                            v-model="selectAll">
                    </th>
                    <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Конструктивный элемент</th>
                    <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Наименование и техническая
                        характеристика
                    </th>
                    <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Количество</th>
                    <th class="sticky top-0 px-6 py-3 bg-indigo-500">
                        <select v-model="selectedPaint" id="selectedPaint" data-te-select-init
                                class="bg-indigo-500 text-indigo-100 text-sm text-center focus:ring-blue-500 focus:border-blue-500
                                block w-full
                               ">

                            <option class="text-sm" v-for="item in paints">{{ item.title }}</option>
                        </select>
                    </th>
                    <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Редактирование</th>
                    <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Удаление</th>
                </tr>
                </thead>
                <tbody class="divide-y bg-gray-100">
                <tr v-for="(material, index) in materials">
                    <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'><input
                        type="checkbox"
                        :value="material.id"
                        v-model="checkedMaterials">
                        <span class="hidden">
                            {{ material.id }}
                        </span>
                    </td>
                    <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{
                            material.element
                        }}
                    </td>
                    <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{
                            material.title
                        }}
                    </td>
                    <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                        {{ material.weight }} т <span v-if="material.quantity">({{
                            Math.floor(material.quantity)
                        }} шт.)</span>
                    </td>
                    <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                        <div v-if="material.paint_color === 'RAL 1021'" class="bg-yellow-400">
                            {{ material.paint }} -
                            {{ material.paint_quantity }} кг
                        </div>
                        <div v-if="material.paint_color === 'RAL 8002'" class="bg-amber-900 text-indigo-100">
                            {{ material.paint }} -
                            {{ material.paint_quantity }} кг
                        </div>
                    </td>
                    <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                        <svg @click.prevent="showUpdate(material)" xmlns="http://www.w3.org/2000/svg"
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
                        <svg @click.prevent="[this.delMaterial = material, this.hideDelete = !hideDelete]"
                             xmlns="http://www.w3.org/2000/svg"
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
                <tr class="relative sticky bottom-0">
                    <td class="text-center text-indigo-100 bg-indigo-500"></td>
                    <td class="text-center text-indigo-100 bg-indigo-500"></td>
                    <td class="text-indigo-100 bg-indigo-500">ИТОГО</td>
                    <td class="text-center text-indigo-100 bg-indigo-500">{{ selectedMaterialWeight.toFixed(2) }}
                        т
                    </td>
                    <td class="text-center text-indigo-100 bg-indigo-500">{{ selectedMaterialPaint.toFixed(2) }}
                        кг
                    </td>
                    <td class="text-center text-indigo-100 bg-indigo-500"></td>
                    <td class="text-center text-indigo-100 bg-indigo-500"></td>
                </tr>
            </table>
        </div>
        <div :class="['shadow-md sm:rounded-lg ', this.hideMaterial ? '' : 'hidden']">
            <form class="p-4 bg-gray-200 mt-4">
                <div class="flex w-full">
                    <div class="w-1/3">
                        <label for="metal"
                               class="block mb-2 mr-2 text-sm font-medium text-gray-900">Выберите
                            конструктивный элемент</label>
                        <select v-model="element" id="element"
                                class="bg-gray-50 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                            <option v-for="item in elements">{{ item.title }}</option>
                        </select>
                        <!--                    {{ this.computedElement.quantity }}-->
                    </div>
                    <div class="w-1/3 ml-2">
                        <label for="metal"
                               class="block mb-2 text-sm font-medium text-gray-900">Выберите
                            металлопрокат</label>
                        <select v-model="metal" id="metal"
                                class="bg-gray-50 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                            <option v-for="item in metals">{{ item.title }}</option>
                        </select>
                    </div>
                    <div v-if="metal" class="flex ml-2 justify-items-center w-full">
                        <div class="mr-2 w-1/3">
                            <label for="characteristic"
                                   class="block mb-2 text-sm font-medium text-gray-900">Выберите
                                размеры</label>
                            <select v-model="title" id="characteristic"
                                    class="w-full bg-gray-50 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg
                                focus:ring-blue-500 focus:border-blue-500 block

                               ">
                                <option v-for="item in computedArray">
                                    {{ item.title }}
                                </option>
                            </select>
                        </div>

                        <div v-if="metal === 'Лист'" class="w-2/6 mr-2">
                            <label for="sheetHeight"
                                   class="block mb-2 text-sm font-medium text-gray-900">Введите
                                ширину листа, мм (при наличии)</label>
                            <input v-model="sheetHeight" id="sheetHeight" type="number"
                                   class="w-full bg-gray-50 mb-3  border border-gray-300 text-gray-900 text-sm rounded-lg
                                focus:ring-blue-500 focus:border-blue-500 block

                               ">
                        </div>
                        <div v-if="metal === 'Лист'" class="w-1/3">
                            <label for="sheetWidth"
                                   class="block mb-2 text-sm font-medium text-gray-900">Введите
                                высоту листа, мм (при наличии)</label>
                            <input v-model="sheetWidth" id="sheetWidth" type="number"
                                   class="w-full bg-gray-50 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg
                                focus:ring-blue-500 focus:border-blue-500 block

                               ">
                        </div>
                        <div
                            v-if="metal === 'Труба' || metal === 'Швеллер' || metal === 'Уголок' || metal === 'Двутавр'"
                            class="w-2/6">
                            <label for="metalLength"
                                   class="block mb-2 text-sm font-medium text-gray-900">Введите
                                длину, мм (при наличии)</label>
                            <input v-model="metalLength" id="metalLength" type="number"
                                   class="w-full bg-gray-50 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg
                                focus:ring-blue-500 focus:border-blue-500 block

                               ">
                        </div>
                    </div>
                </div>
                <div class="flex w-full">
                    <div v-if="metal" class="w-full">
                        <label for="standard"
                               class="block mb-2 text-sm font-medium text-gray-900">Выберите
                            ГОСТ</label>
                        <select v-model="standard" id="standard"
                                class="bg-gray-50 w-full mb-2 border border-gray-300 text-gray-900 text-sm rounded-lg
                                focus:ring-blue-500 focus:border-blue-500 block

                               ">
                            <option v-for="item in selectedStandards">
                                {{ item.title }}
                            </option>
                        </select>
                    </div>
                    <div :class="['w-full', metal ? 'ml-2' : '']">
                        <label for="steel"
                               class="block mb-2 text-sm font-medium text-gray-900">Выберите
                            сталь</label>
                        <select v-model="steel" id="steel"
                                class="bg-gray-50 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg
                                focus:ring-blue-500 focus:border-blue-500 block w-full

                               ">
                            <option v-for="item in steels">
                                {{ item.title }} {{ item.steel_standard }}
                            </option>
                        </select>
                    </div>
                    <div class="w-full px-2">
                        <label for="quantity"
                               class="block mb-2 text-sm font-medium text-gray-900">Введите
                            количество</label>
                        <input v-model="quantity" id="quantity" type="number" step="0.001"
                               class="bg-gray-50 h-9 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg
                                focus:ring-blue-500 focus:border-blue-500 block w-full

                               ">
                    </div>
                    <div class="w-full">
                        <label for="unit" class="block mb-2 text-sm font-medium text-gray-900">Выберите
                            единицы измерения</label>
                        <div v-if="!metalLength && !sheetHeight">
                            <select v-model="unit" id="unit"
                                    class="bg-gray-50 mb-3  border border-gray-300 text-gray-900 text-sm
                                            rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full

                                           ">
                                <option v-for="item in units">{{ item.title }}</option>
                            </select>
                        </div>
                        <div v-if="metalLength || sheetHeight">
                            <select v-model="unit" id="unit"
                                    class="bg-gray-50 mb-3 border border-gray-300 text-gray-900 text-sm
                                            rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full

                                           ">
                                <option> {{ 'шт.' }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button @click.prevent="addMaterial" type="button"
                        class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500
                                            hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300
                                            font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2">
                    Создать
                </button>
                <button @click.prevent="hideStore" type="button"
                        class="text-white bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    Отмена
                </button>
            </form>
        </div>
        <div v-if="updMaterial"
             :class="['bg-gray-200sm:rounded-lg w-full', this.hideUpdate ? '' : 'hidden']">
            <form class="p-4 bg-gray-200 mt-4">
                <p class="p-2 italic">Редактирование "{{ updMaterial.title }}"</p>
                <div class="w-2/5 mx-2">
                    <label for="updTitle"
                           class="block mb-1 text-sm font-medium text-gray-900">Наименование</label>
                    <input v-model="updTitle" id="updTitle"
                           class="bg-gray-50 h-9 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg
                                focus:ring-blue-500 focus:border-blue-500 block w-full

                               ">
                </div>
                <div class="flex justify-between px-3 w-full">
                    <div class="w-2/6 pr-2">
                        <label for="updWeight"
                               class="block mb-1 text-sm font-medium text-gray-900">Вес, т</label>
                        <input v-model="updWeight" id="updWeight" type="number" step="0.001"
                               class="w-full bg-gray-50 h-9 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg
                                focus:ring-blue-500 focus:border-blue-500 block

                               ">
                    </div>
                    <div class="w-2/6 pr-2">
                        <label for="updLength"
                               class="block mb-1 text-sm font-medium text-gray-900">Длина, м</label>
                        <input v-model="updLength" id="updLength" type="number" step="0.001"
                               class="w-full bg-gray-50 h-9 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg
                                focus:ring-blue-500 focus:border-blue-500 block w-full

                               ">
                    </div>
                    <div class="w-2/6">
                        <label for="updArea"
                               class="block mb-1 text-sm font-medium text-gray-900">Площадь,
                            м2</label>
                        <input v-model="updArea" id="updArea" type="number" step="0.001"
                               class="bg-gray-50 h-9 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg
                                focus:ring-blue-500 focus:border-blue-500 block w-full

                               ">
                    </div>

                </div>
                <div class="flex justify-between px-3 w-full">
                    <div class="w-1/3 pr-2">
                        <label for="paint"
                               class="block mb-1 mr-2 text-sm font-medium text-gray-900">Выберите
                            краску</label>
                        <select v-model="paint" id="element"
                                class="bg-gray-50 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                            <option v-for="item in paints">{{ item.title }}</option>
                        </select>
                    </div>
                    <div class="w-1/3 pr-2">
                        <label for="metal"
                               class="block mb-1 mr-2 text-sm font-medium text-gray-900">Выберите
                            количество слоёв</label>
                        <select v-model="numberOfLayers" id="numberOfLayers"
                                class="bg-gray-50 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                        focus:border-blue-500 block w-full
                       ">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </div>
                    <div class="w-1/3">
                        <label for="color"
                               class="block mb-1 mr-2 text-sm font-medium text-gray-900">Выберите
                            цвет</label>
                        <select v-model="color" id="color"
                                class="bg-gray-50 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                        focus:border-blue-500 block w-full
                       ">
                            <option class="bg-gray-400">RAL 7004</option>
                            <option class="bg-yellow-400">RAL 1021</option>
                            <option class="bg-sky-500">RAL 5015</option>
                            <option class="bg-amber-900">RAL 8002</option>
                            <option>RAL 3020</option>
                        </select>
                    </div>
                </div>
                <button @click.prevent="updateMaterial" type="button"
                        class="ml-2 text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    Отправить
                </button>
                <button @click.prevent="closeUpdate" type="button"
                        class="text-white bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    Отмена
                </button>
            </form>
        </div>
        <DeleteComponent :del-element="this.delMaterial" :hide-delete="this.hideDelete" :del-title="'material'"  @closeDelete="close"></DeleteComponent>
    </div>
    <div v-if="selectedMaterialWeight" class="mt-2 ml-2">
        {{ selectedMaterialWeight }}
    </div>
    <!--                <Link :href="route('all')">-->
    <!--                    Набивка материала-->
    <!--                </Link>-->
</template>

<script>

import UserLayout from "@/Layouts/UserLayout.vue";
import {Link} from "@inertiajs/vue3";
import DeleteComponent from "@/Components/DeleteComponent.vue";

export default {

    name: "Index",

    data() {
        return {
            element: '',
            unit: '',
            metal: '',
            title: '',
            characteristic: '',
            sheetHeight: null,
            sheetWidth: null,
            metalLength: null,
            standard: '',
            steel: '',
            steel_standard: '',
            quantity: null,
            measure_units: '',
            tonLength: null,
            tonArea: null,
            hideMaterial: false,
            hideUpdate: false,
            hideDelete: false,
            updMaterial: null,
            updId: null,
            updTitle: '',
            updWeight: null,
            updLength: null,
            updArea: null,
            delMaterial: null,
            errors: Object,
            paint: '',
            numberOfLayers: null,
            color: '',
            selectedPaint: '',
            checkedMaterials: [],
            products: [
                {
                    id: 1,
                    title: 'Product 1',
                    price: 50,
                    qt: 1000,
                },
                {
                    id: 2,
                    title: 'Product 2',
                    price: 100,
                    qt: 500,
                },
            ]
        }
    },

    layout: UserLayout,

    components: {
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
        computedArray() {
            return this.characteristics.filter(item => item.metal === this.metal)
        },

        computedElement() {
            return this.elements.filter(item => item.title === this.element)[0]
        },

        selectedStandards() {
            return this.standards.filter(item => item.metal === this.metal)
        },

        allSelectedMaterials() {
            return this.materials.filter((material) =>
                this.checkedMaterials.includes(material.id))
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
                return this.materials ? this.checkedMaterials.length === this.materials.length : false;
            },
            set: function (value) {
                const selected = [];

                if (value) {
                    this.materials.forEach(function (material) {
                        selected.push(material.id);
                    });
                }

                this.checkedMaterials = selected;
            }
        },

        // uniqueSelectedQuantity() {
        //     return [...new Set(this.selectedMaterialQuantity)]
        // }

    },

    methods: {
        addMaterial() {

            let preCalculateQuantity = this.quantity
            let elementTitle = this.element

            if (this.computedElement.quantity) {
                preCalculateQuantity = this.computedElement.quantity * this.quantity
                elementTitle = this.element + ' - ' + this.computedElement.quantity + ' шт.'
            }

            this.$inertia.post('/materials', {
                project_id: this.project.data.id,
                element: elementTitle,
                metal: this.metal,
                title: this.title,
                sheetHeight: this.sheetHeight,
                sheetWidth: this.sheetWidth,
                metalLength: this.metalLength,
                standard: this.standard,
                steel: this.steel,
                quantity: preCalculateQuantity,
                measure_units: this.unit,
            })

            this.hideMaterial = !this.hideMaterial
            this.element = ''
            this.metal = ''
            this.title = ''
            this.sheetHeight = null
            this.sheetWidth = null
            this.metalLength = null
            this.standard = ''
            this.steel = ''
            this.quantity = null
            this.unit = ''
        },

        hideStore() {
            this.hideMaterial = !this.hideMaterial
            this.element = ''
            this.metal = ''
            this.title = ''
            this.characteristic = ''
            this.sheetHeight = null
            this.sheetWidth = null
            this.standard = ''
            this.steel = ''
            this.quantity = null
            this.unit = ''
        },

        showDelete(material) {
            this.hideDelete = !this.hideDelete
            this.delMaterial = material
        },

        showUpdate(material) {
            this.hideUpdate = !this.hideUpdate
            this.updMaterial = material
            this.updId = material.id
            this.updTitle = material.title
            this.updWeight = material.weight
            this.updLength = material.length
            this.updArea = material.area
        },

        closeUpdate() {
            this.updMaterial = ''
            this.updId = null
            this.updTitle = ''
            this.updWeight = null
            this.updLength = null
            this.updArea = null
            this.hideUpdate = !this.hideUpdate
        },

        close() {
            this.delMaterial = ''
            this.hideDelete = !this.hideDelete
        },

        updateMaterial() {
            this.$inertia.patch('/materials/' + this.updId, {
                title: this.updTitle,
                weight: this.updWeight,
                length: this.updLength,
                area: this.updArea,
                paint: this.paint,
                numberOfLayers: this.numberOfLayers,
                paint_color: this.color,
            });
            this.updMaterial = ''
            this.updId = null
            this.updTitle = ''
            this.updWeight = null
            this.updLength = null
            this.updArea = null
            this.hideUpdate = !this.hideUpdate
            this.paint = ''
            this.numberOfLayers = null
            this.color = ''
        },

        test(words) {
            if (words) {
                const n = words.split(" ");
                return n[n.length - 1];
            }
            return ''
        }
    },
}

</script>

<style scoped>

</style>
