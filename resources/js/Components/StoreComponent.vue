<template>
    <div :class="['shadow-md sm:rounded-lg group-hover:animate-trans-right', this.hideMaterial ? '' : 'hidden']">
        <form class="p-4 bg-gray-200 mt-4 w-full">
            <div class="grid grid-cols-4 w-full mb-3">
                <div v-if="element !== 'standard'">
                    <label for="title" class="text-amber=200">Наименование {{ this.elementTitle }}</label>
                    <input v-model="title" type="text" id="title"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                               focus:border-blue-500 block w-full p-2.5"
                           :placeholder="[`Наименование ${ this.elementTitle }`]" required>
                </div>
                <div v-if="element === 'paint'" class="ml-2">
                    <label for="consumption" class="text-amber=200">Расход краски</label>
                    <input v-model="consumption" type="text" id="consumption"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                           placeholder="Расход краски" required>
                </div>
                <div v-if="element === 'steel'" class="ml-2">
                    <label for="steelStandard" class="text-amber=200">ГОСТ марки стали</label>
                    <input v-model="steelStandard" type="text" id="steelStandard"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                           placeholder="ГОСТ марки стали" required>
                </div>
                <div v-if="element === 'project'" class="ml-2">
                    <label for="change" class="text-amber=200">Изм. №</label>
                    <input v-model="change" type="number" id="change"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                           placeholder="Изм. №" required>
                </div>
                <div v-if="element === 'standard'" class="ml-2">
                    <label for="metal" class="text-amber=200 mb-2">Металл</label>
                    <select v-model="metal" id="metal"
                            class="bg-gray-50 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                        <option v-for="item in metals">{{ item.title }}</option>
                    </select>
                </div>
                <div v-if="element === 'standard'" class="ml-2">
                    <label for="standardType" class="text-amber=200 mb-2">Тип стандарта</label>
                    <select v-model="standardType" id="standardType"
                            class="bg-gray-50 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                        <option v-for="item in standardTypes">{{ item }}</option>
                    </select>
                </div>
                <div v-if="element === 'standard'" class="ml-2">
                    <label for="title" class="text-amber=200 mb-2">Номер стандарта</label>
                    <input v-model="standardNumber" type="text" id="title"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                           placeholder="Номер стандарта" required>
                </div>
            </div>
            <button @click.prevent="addElement" type="button"
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
    name: "StoreComponent",

    data() {
        return {
            title: '',
            consumption: null,
            steelStandard: '',
            change: null,
            metal: '',
            standardType: '',
            standardNumber: '',
            project: '',
            quantity: '',
            standardTypes: ['ГОСТ', 'ТУ', 'СТО'],
        }
    },

    props: [
        'hideMaterial',
        'element',
        'elementTitle',
        'bush_id',
        'metals',
        'projects',
    ],

    methods: {

        addElement() {

            let universalTitle = this.title
            if (this.element === 'standard') {
                universalTitle = this.standardType + ' ' + this.standardNumber
            }

            this.$inertia.post(route(`store.${this.element}`),
                {
                    title: universalTitle,
                    consumption: this.consumption,
                    steel_standard: this.steelStandard,
                    change: this.change,
                    bush_id: this.bush_id,
                    metal: this.metal,
                    project: this.project,
                    quantity: this.quantity,
                }
            )
            this.title = ''
            this.steelStandard = ''
            this.consumption = null
            this.change = null
            this.standardType = ''
            this.standardNumber = ''
            this.metal = ''

            this.$emit('closeStore')
        },

        closeStore() {

            this.title = ''
            this.steelStandard = ''
            this.consumption = null
            this.change = null

            this.$emit('closeStore')
        }
    }
}
</script>
