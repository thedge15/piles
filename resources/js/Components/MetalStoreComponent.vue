<template>
    <div :class="['shadow-md sm:rounded-lg ', this.hideProduct ? '' : 'hidden']">
        <form class="p-4 bg-gray-200 mt-4 w-full">
            <div class="grid gap-6 mb-6 md:grid-cols-5">
                <div
                    v-if="metal.data.title === 'Швеллер'
                            || metal.data.title === 'Двутавр' || metal.data.title === 'Лист просечно-вытяжной'
                            || metal.data.title === 'Профлист'">
                    <label for="title" class="text-orange-600">Марка металлопроката</label>
                    <input v-model="title" type="text" id="title"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                           placeholder="Марка металлопроката" required>
                </div>
                <div v-if="metal.data.title === 'Уголок'">
                    <label for="size" class="text-orange-600">Длина полки уголка</label>
                    <input v-model="size" type="number" id="size"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                           placeholder="Длина полки уголка" required>
                </div>
                <div v-if="metal.data.title === 'Уголок'">
                    <label for="second_size" class="text-orange-600">Длина второй полки уголка</label>
                    <input v-model="second_size" type="number" id="second_size"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                           placeholder="Длина второй полки уголка" required>
                </div>
                <div v-if="metal.data.title === 'Труба' || metal.data.title === 'Круг'">
                    <label for="diameter" class="text-orange-600">Диаметр</label>
                    <input v-model="diameter" type="number" id="diameter"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                           placeholder="Диаметр" required>
                </div>
                <div v-if="metal.data.title === 'Труба квадратная'">
                    <label for="width" class="text-orange-600">Ширина квадратной трубы</label>
                    <input v-model="width" type="number" id="width"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                           placeholder="Ширина квадратной трубы" required>
                </div>
                <div v-if="metal.data.title === 'Труба квадратная'">
                    <label for="height" class="text-orange-600">Высота квадратной трубы</label>
                    <input v-model="height" type="number" id="height"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                           placeholder="Высота квадратной трубы" required>
                </div>
                <div
                    v-if="metal.data.title === 'Уголок' || metal.data.title === 'Труба' || metal.data.title === 'Труба квадратная'">
                    <label for="wall" class="text-orange-600">Толщина стенки</label>
                    <input v-model="wall" type="number" id="wall"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                           placeholder="Толщина стенки" required>
                </div>
                <div v-if="metal.data.title === 'Лист' || metal.data.title === 'Лист рулонный'">
                    <label for="thickness" class="text-orange-600">Толщина листа</label>
                    <input v-model="thickness" type="number" id="thickness"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                           placeholder="Толщина листа" required>
                </div>
                <div v-if="metal.data.title !== 'Лист'
                        && metal.data.title !== 'Лист просечно-вытяжной'
                        && metal.data.title !== 'Профлист'
                        && metal.data.title !== 'Лист рулонный'">
                    <label for="tonLength" class="text-orange-600">Длина тонны металлопроката</label>
                    <input v-model="tonLength" type="number" step="0.01" id="tonLength"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                           placeholder="Длина тонны металлопроката" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"
                           required>
                </div>
                <div
                    v-if="metal.data.title !== 'Труба' && metal.data.title !== 'Труба квадратная' && metal.data.title !== 'Круг'">
                    <label for="tonArea" class="text-orange-600">Площадь тонны металлопроката</label>
                    <input v-model="tonArea" type="number" step="0.01" id="tonArea"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                           placeholder="Площадь тонны металлопроката" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"
                           required>
                </div>
            </div>
            <button @click.prevent="addCharacteristic" type="button"
                    class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500
                                            hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300
                                            font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
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
    name: "MetalStoreComponent",

    data() {
        return {
            title: '',
            size: null,
            second_size: null,
            diameter: null,
            width: null,
            height: null,
            wall: null,
            thickness: null,
            tonLength: null,
            tonArea: null,
        }
    },

    props: [
        'hideProduct',
        'metal',
    ],

    methods: {
        addCharacteristic() {
            let computedTonArea;
            if (this.metal.data.title === 'Труба' || this.metal.data.title === 'Круг') {
                computedTonArea = this.diameter * Math.PI * this.tonLength / 1000
            } else if (this.metal.data.title === 'Труба квадратная') {
                computedTonArea = 2 * (this.height / 1000 + this.width / 1000) * this.tonLength
            } else {
                computedTonArea = this.tonArea
            }
            this.$inertia.post(route('store.characteristic'), {
                metal_id: this.metal.data.id,
                title: this.title,
                width: this.width,
                height: this.height,
                wall: this.wall,
                size: this.size,
                second_size: this.second_size,
                thickness: this.thickness,
                diameter: this.diameter,
                ton_length: this.tonLength,
                ton_area: computedTonArea,
            })
            this.title = null
            this.size = null
            this.second_size = null
            this.diameter = null
            this.width = null
            this.height = null
            this.wall = null
            this.thickness = null
            this.tonLength = null
            this.tonArea = null
            this.$emit('closeStore')
        },

        closeStore() {
            this.title = null
            this.size = null
            this.second_size = null
            this.diameter = null
            this.width = null
            this.height = null
            this.wall = null
            this.thickness = null
            this.tonLength = null
            this.tonArea = null
            this.$emit('closeStore')
        }
    }
}
</script>


<style scoped>

</style>
