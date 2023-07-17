<template>
    <div :class="['shadow-md sm:rounded-lg ', this.hideMaterial ? '' : 'hidden']">
        <form class="p-4 bg-gray-200 mt-4 w-full">
            <div class="flex w-full">
                <div v-if="element !== 'standard' && element !== 'element'" class="grid gap-3 mb-6 md:grid-cols-2">
                    <div>
                        <label for="title" class="text-amber=200">Наименование {{ this.elementTitle }}</label>
                        <input v-model="title" type="text" id="title"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                               :placeholder="[`Наименование ${ this.elementTitle }`]" required>
                    </div>
                </div>
                <div v-if="element === 'paint'" class="grid gap-6 mb-6 md:grid-cols-3">
                    <div>
                        <label for="consumption" class="text-amber=200">Расход краски</label>
                        <input v-model="consumption" type="text" id="consumption"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                               placeholder="Расход краски" required>
                    </div>
                </div>
                <div v-if="element === 'steel'" class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="steelStandard" class="text-amber=200">ГОСТ марки стали</label>
                        <input v-model="steelStandard" type="text" id="steelStandard"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                               placeholder="ГОСТ марки стали" required>
                    </div>
                </div>
                <div v-if="element === 'project'" class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="change" class="text-amber=200">Изм. №</label>
                        <input v-model="change" type="number" id="change"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                               placeholder="Изм. №" required>
                    </div>
                </div>
                <div v-if="element === 'standard'" class="p-4">
                    <div class="flex">
                        <div class="grid gap-2 mb-6 md:grid-cols-3 w-full">
                            <div>
                                <label for="metal" class="text-amber=200 mb-2">Металл</label>
                                <select v-model="metal" id="metal"
                                        class="bg-gray-50 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                                    <option v-for="item in metals">{{ item.title }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid gap-2 mb-6 md:grid-cols-3 w-full">
                            <div>
                                <label for="standardType" class="text-amber=200 mb-2">Тип стандарта</label>
                                <select v-model="standardType" id="standardType"
                                        class="bg-gray-50 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                                    <option>ГОСТ</option>
                                    <option>ТУ</option>
                                    <option>СТО</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid gap-2 mb-6 md:grid-cols-3 w-full">
                            <div>
                                <label for="title" class="text-amber=200 mb-2">Номер стандарта</label>
                                <input v-model="standardNumber" type="text" id="title"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                       placeholder="Номер стандарта" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="element === 'element'" class="p-4 bg-gray-200 mt-4">
                    <div class="flex w-full">
                        <div class="w-full">
                            <label for="project"
                                   class="block mb-2 mr-2 text-sm font-medium text-gray-900">Выберите
                                проект</label>
                            <select v-model="project" id="project"
                                    class="bg-gray-50 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                                <option v-for="item in projects">{{ item.title }}</option>
                            </select>
                        </div>
                        <div class="w-full px-2 mx-1">
                            <label for="title"
                                   class="block mb-2 text-sm font-medium text-gray-900">Введите наименование</label>
                            <input v-model="title" id="title"
                                   class="bg-gray-50 h-9 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg
                                focus:ring-blue-500 focus:border-blue-500 block w-full">
                        </div>
                        <!--                            <div class="w-1/3">-->
                        <!--                                <label for="quantity"-->
                        <!--                                       class="block mb-2 text-sm font-medium text-gray-900">Введите количество,-->
                        <!--                                    шт.</label>-->
                        <!--                                <input v-model="quantity" id="quantity" type="number"-->
                        <!--                                       class="bg-gray-50 h-9 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg-->
                        <!--                                focus:ring-blue-500 focus:border-blue-500 block w-full">-->
                        <!--                            </div>-->
                    </div>
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
import storeData from "@/storeData";
// import

export default {
    name: "StoreComponent",

    ...storeData,

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


<style scoped>

</style>
