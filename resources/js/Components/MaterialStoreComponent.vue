<template>
    <div :class="['shadow-md sm:rounded-lg', this.hideMaterial ? '' : 'hidden']">
        <form :class="['p-2 bg-gray-200 mt-4', this.fadeOut ? '' : 'animate-fade']">
            <div class="grid grid-cols-5 w-full">
                <div>
                    <label for="metal">Выберите конструктивный элемент</label>
                    <select v-model="element" id="element" class="border border-gray-300
                    focus:ring-blue-500 focus:border-blue-500">
                        <option v-for="item in elements">{{ item.title }}</option>
                    </select>
                </div>
                <div class="ml-2">
                    <label for="metal">Выберите металлопрокат</label>
                    <select v-model="metal" id="metal" class="border border-gray-300
                    focus:ring-blue-500 focus:border-blue-500">
                        <option v-for="item in metals">{{ item.title }}</option>
                    </select>
                </div>
                <div v-if="metal" class="ml-2">
                    <label for="characteristic">Выберите размеры</label>
                    <select v-model="title" id="characteristic" class="border border-gray-300
                    focus:ring-blue-500 focus:border-blue-500">
                        <option v-for="item in computedArray">{{ item.title }}</option>
                    </select>
                </div>
                <div v-if="metal && metal === 'Лист'" class="ml-2">
                    <label for="sheetHeight">Введите ширину листа, мм (при наличии)</label>
                    <input v-model="sheetHeight" id="sheetHeight" type="number" class="border
                    border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div v-if="metal && metal === 'Лист'" class="ml-2">
                    <label for="sheetWidth">Введите высоту листа, мм (при наличии)</label>
                    <input v-model="sheetWidth" id="sheetWidth" type="number" class="border
                    border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div v-if="metal === 'Труба' || metal === 'Швеллер' || metal === 'Уголок' || metal === 'Двутавр'"
                     class="ml-2">
                    <label for="metalLength">Введите длину, мм (при наличии)</label>
                    <input v-model="metalLength" id="metalLength" type="number" class="border
                    border-gray-300 focus:ring-blue-500 focus:border-blue-500 block">
                </div>
            </div>
            <div class="grid grid-cols-5 w-full">
                <div>
                    <label for="standard">Выберите ГОСТ</label>
                    <select v-model="standard" id="standard" class="mb-2 border border-gray-300 focus:ring-blue-500
                        focus:border-blue-500">
                        <option v-for="item in selectedStandards">{{ item.title }}</option>
                    </select>
                </div>
                <div class="ml-2">
                    <label for="steel">Выберите сталь</label>
                    <select v-model="steel" id="steel" class="border border-gray-300
                    focus:ring-blue-500 focus:border-blue-500">
                        <option v-for="item in steels">{{ item.title }} {{ item.steel_standard }}</option>
                    </select>
                </div>
                <div class="ml-2">
                    <label for="quantity">Введите количество</label>
                    <input v-model="quantity" id="quantity" type="number" step="0.001" class="mb-3
                    border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="ml-2">
                    <label for="unit">Выберите единицы измерения</label>
                    <div v-if="!metalLength && !sheetHeight">
                        <select v-model="unit" id="unit" class="border border-gray-300 focus:ring-blue-500
                        focus:border-blue-500 block">
                            <option class="italic" v-for="item in units">{{ item }}</option>
                        </select>
                    </div>
                    <div v-if="metalLength || sheetHeight">
                        <select v-model="unit" id="unit" class="border border-gray-300
                        text-sm focus:ring-blue-500 focus:border-blue-500 block">
                            <option> {{ 'шт.' }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <button @click.prevent="addMaterial" type="button" :disabled="!metal"
                    class="text-gray-900 bg-gradient-to-r from-lime-200
            via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300
            font-medium text-sm px-5 py-2.5 text-center mr-2">
                Создать
            </button>
            <button @click.prevent="closeStore" type="button"
                    class="text-white bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300 font-medium text-sm px-5 py-2.5 text-center mr-2 mb-2">
                Отмена
            </button>
        </form>
    </div>
</template>

<script>
export default {
    name: "MaterialStoreComponent",

    data() {
        return {
            element: '',
            metal: '',
            title: '',
            sheetHeight: null,
            sheetWidth: null,
            metalLength: null,
            standard: '',
            steel: '',
            quantity: null,
            unit: '',
            fadeOut: true,
        }
    },

    props: [
        'hideMaterial',
        'project_id',
        'elements',
        'metals',
        'characteristics',
        'standards',
        'steels',
        'units',
        // 'errors',
    ],

    computed: {

        computedArray() {
            return this.characteristics.filter(item => item.metal.data.title === this.metal);
        },

        computedMetalId() {
            return this.metals.filter(item => item.title === this.metal)
        },

        computedCharacteristicId() {
            return this.characteristics.filter(item => item.id === 1);
        },

        selectedStandards() {
            return this.standards.filter(item => item.metal === this.metal)
        },

        computedElement() {
            return this.elements.filter(item => item.title === this.element)[0]
        },
    },

    methods: {

        addMaterial() {
            this.$inertia.post('/materials', {
                project_id: this.project_id,
                element: this.element,
                metal: this.metal,
                metal_id: this.computedMetalId[0].id,
                title: this.title,
                sheetHeight: this.sheetHeight,
                sheetWidth: this.sheetWidth,
                metalLength: this.metalLength,
                standard: this.standard,
                steel: this.steel,
                quantity: this.quantity,
                measure_units: this.unit,
            })
            this.closeStore()
        },

        closeStore() {
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

            this.$emit('closeStore')
        },
    }
}
</script>
