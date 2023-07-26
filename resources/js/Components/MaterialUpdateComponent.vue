<template>
    <div v-if="updMaterial"
         :class="['bg-gray-200sm:rounded-lg w-full', this.hideUpdate ? '' : 'hidden']">
        <form class="p-4 bg-gray-200 mt-4">
            <p class="p-2 italic">Редактирование "{{ updMaterial.title }}"</p>
            <div class="flex">
                <div class="w-2/5 mx-2">
                    <label for="title"
                           class="block mb-1 text-sm font-medium text-gray-900">Наименование</label>
                    <input v-model="updMaterial.title" id="title"
                           class="bg-gray-50 h-9 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg
                                focus:ring-blue-500 focus:border-blue-500 block w-full">
                </div>
                <div class="w-2/5 mx-2">
                    <label for="updElement"
                           class="block mb-1 text-sm font-medium text-gray-900">Элемент</label>
                    <select v-model="updMaterial.element" id="updElement"
                            class="bg-gray-50 h-9 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg
                                focus:ring-blue-500 focus:border-blue-500 block w-full">
                        <option v-for="item in elements">{{ item.title }}</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-between px-3 w-full">
                <div class="w-2/6 pr-2">
                    <label for="updWeight"
                           class="block mb-1 text-sm font-medium text-gray-900">Вес, т</label>
                    <input v-model="updMaterial.weight" id="updWeight" type="number" step="0.001"
                           class="w-full bg-gray-50 h-9 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg
                                            focus:ring-blue-500 focus:border-blue-500 block">
                </div>
                <div class="w-2/6 pr-2">
                    <label for="updLength"
                           class="block mb-1 text-sm font-medium text-gray-900">Длина, м</label>
                    <input v-model="updMaterial.length" id="updLength" type="number" step="0.001"
                           class="w-full bg-gray-50 h-9 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-blue-500 focus:border-blue-500 block w-full">
                </div>
                <div class="w-2/6">
                    <label for="updArea"
                           class="block mb-1 text-sm font-medium text-gray-900">Площадь,
                        м2</label>
                    <input v-model="updMaterial.area" id="updArea" type="number" step="0.001"
                           class="bg-gray-50 h-9 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-blue-500 focus:border-blue-500 block w-full">
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
                        focus:border-blue-500 block w-full">
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
                        focus:border-blue-500 block w-full">
                        <option class="bg-gray-400">RAL 7004</option>
                        <option class="bg-yellow-400">RAL 1021</option>
                        <option class="bg-sky-500">RAL 5015</option>
                        <option class="bg-amber-900">RAL 8002</option>
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
</template>

<script>
export default {
    name: "MaterialUpdateComponent",

    data() {
        return {
            paint: '',
            numberOfLayers: null,
            color: '',
        }
    },

    props: [
        'hideUpdate',
        'updMaterial',
        'elements',
        'paints',
    ],

    methods: {
        updateMaterial() {
            this.$inertia.patch('/materials/' + this.updMaterial.id, {
                element: this.updMaterial.element,
                title: this.updMaterial.title,
                weight: this.updMaterial.weight,
                length: this.updMaterial.length,
                area: this.updMaterial.area,
                paint: this.paint,
                numberOfLayers: this.numberOfLayers,
                paint_color: this.color,
            });
            this.paint = ''
            this.numberOfLayers = null
            this.color = ''
            this.$emit('closeUpdate')
        },

        closeUpdate() {
            this.$emit('closeUpdate')
        },
    },

}
</script>

<style scoped>

</style>
