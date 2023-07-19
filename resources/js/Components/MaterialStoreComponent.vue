<template>
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
                            <option v-for="item in computedArray">{{ item.title }}</option>
                        </select>
                    </div>
                    <div v-if="metal === 'Лист'" class="w-2/6 mr-2">
                        <label for="sheetHeight"
                               class="block mb-2 text-sm font-medium text-gray-900">Введите
                            ширину листа, мм (при наличии)</label>
                        <input v-model="sheetHeight" id="sheetHeight" type="number"
                               class="w-full bg-gray-50 mb-3  border border-gray-300 text-gray-900 text-sm rounded-lg
                                                    focus:ring-blue-500 focus:border-blue-500 block">
                    </div>
                    <div v-if="metal === 'Лист'" class="w-1/3">
                        <label for="sheetWidth"
                               class="block mb-2 text-sm font-medium text-gray-900">Введите
                            высоту листа, мм (при наличии)</label>
                        <input v-model="sheetWidth" id="sheetWidth" type="number"
                               class="w-full bg-gray-50 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                    focus:ring-blue-500 focus:border-blue-500 block">
                    </div>
                    <div
                        v-if="metal === 'Труба' || metal === 'Швеллер' || metal === 'Уголок' || metal === 'Двутавр'"
                        class="w-2/6">
                        <label for="metalLength"
                               class="block mb-2 text-sm font-medium text-gray-900">Введите
                            длину, мм (при наличии)</label>
                        <input v-model="metalLength" id="metalLength" type="number"
                               class="w-full bg-gray-50 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                    focus:ring-blue-500 focus:border-blue-500 block">
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
                                                    focus:ring-blue-500 focus:border-blue-500 block">
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
                                                focus:ring-blue-500 focus:border-blue-500 block w-full">
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
                                                focus:ring-blue-500 focus:border-blue-500 block w-full">
                </div>
                <div class="w-full">
                    <label for="unit" class="block mb-2 text-sm font-medium text-gray-900">Выберите
                        единицы измерения</label>
                    <div v-if="!metalLength && !sheetHeight">
                        <select v-model="unit" id="unit"
                                class="bg-gray-50 mb-3  border border-gray-300 text-gray-900 text-sm
                                                                rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                            <option v-for="item in units">{{ item.title }}</option>
                        </select>
                    </div>
                    <div v-if="metalLength || sheetHeight">
                        <select v-model="unit" id="unit"
                                class="bg-gray-50 mb-3 border border-gray-300 text-gray-900 text-sm
                                                                rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
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
            <button @click.prevent="closeStore" type="button"
                    class="text-white bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
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
        // 'elementTitle'
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

    mounted() {
        this.showElement()
    },

    methods: {

        showElement() {
            console.log(typeof this.computedArray);
        },

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

        closeStore() {
            this.element = ''
            this.metal = ''
            this.title = ''
            this.sheetHeight = null
            this.sheetWidth = null
            this.metalLength = null
            this.$emit('closeStore')
        }
    }
}
</script>


<style scoped>

</style>
