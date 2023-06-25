<template>
    <div class="flex flex-col h-screen py-5">
        <Link :href="route('metal.index')" class="text-center italic">
            {{ metal.data.title }}
        </Link>
        <button @click.prevent="this.hideProduct = !hideProduct" type="button"
                class="w-1/12 mb-2 text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600
                        hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300
                        dark:focus:ring-teal-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
            Создать
        </button>
        <!-- component -->
        <div class="flex-grow overflow-auto">
            <table v-if="metals" class="relative w-full border mb-3">
                <thead>
                <tr>
                    <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">№</th>
                    <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Размеры</th>
                    <th v-if="metal.data.title !== 'Лист' && metal.data.title !== 'Лист просечно-вытяжной' && metal.data.title !== 'Лист рулонный'"
                        class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Длина тонны, м
                    </th>
                    <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Площадь тонны, м<sup>2</sup></th>
                    <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Редактирование</th>
                    <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Удаление</th>
                </tr>
                </thead>
                <tbody class="divide-y bg-gray-100">
                <tr v-for="(product, index) in metals.data">
                    <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ index + 1 }}</td>
                    <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                        {{ product.title }}
                    </td>
                    <td v-if="metal.data.title !== 'Лист' && metal.data.title !== 'Лист просечно-вытяжной' && metal.data.title !== 'Лист рулонный'"
                        :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                        {{ product.ton_length }}
                    </td>
                    <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                        {{ product.ton_area }}
                    </td>
                    <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                        <svg @click.prevent="showUpdate(product)" xmlns="http://www.w3.org/2000/svg"
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
                        <svg @click.prevent="showDelete(product)" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor"
                             class="w-6 h-6 mx-auto cursor-pointer">
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
            </table>
            <div :class="['relative overflow-x-auto shadow-md sm:rounded-lg', this.hideProduct ? '' : 'hidden']">
                <form class="p-4">
                    <div class="grid gap-6 mb-6 md:grid-cols-5">
                        <div
                            v-if="metal.data.title === 'Швеллер'
                            || metal.data.title === 'Двутавр'
                            || metal.data.title === 'Лист просечно-вытяжной'
                            || metal.data.title === 'Профлист'"
                        >
                            <label for="mark" class="text-orange-600">Марка металлопроката</label>
                            <input v-model="mark" type="text" id="mark"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Марка металлопроката" required>
                        </div>
                        <div v-if="metal.data.title === 'Уголок'">
                            <label for="size" class="text-orange-600">Длина полки уголка</label>
                            <input v-model="size" type="number" id="size"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Длина полки уголка" required>
                        </div>
                        <div v-if="metal.data.title === 'Уголок'">
                            <label for="second_size" class="text-orange-600">Длина второй полки уголка</label>
                            <input v-model="second_size" type="number" id="second_size"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Длина второй полки уголка" required>
                        </div>
                        <div v-if="metal.data.title === 'Труба' || metal.data.title === 'Круг'">
                            <label for="diameter" class="text-orange-600">Диаметр</label>
                            <input v-model="diameter" type="number" id="diameter"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Диаметр" required>
                        </div>
                        <div v-if="metal.data.title === 'Труба квадратная'">
                            <label for="width" class="text-orange-600">Ширина квадратной трубы</label>
                            <input v-model="width" type="number" id="width"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Ширина квадратной трубы" required>
                        </div>
                        <div v-if="metal.data.title === 'Труба квадратная'">
                            <label for="height" class="text-orange-600">Высота квадратной трубы</label>
                            <input v-model="height" type="number" id="height"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Высота квадратной трубы" required>
                        </div>
                        <div
                            v-if="metal.data.title === 'Уголок' || metal.data.title === 'Труба' || metal.data.title === 'Труба квадратная'">
                            <label for="wall" class="text-orange-600">Толщина стенки</label>
                            <input v-model="wall" type="number" id="wall"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Толщина стенки" required>
                        </div>
                        <div v-if="metal.data.title === 'Лист' || metal.data.title === 'Лист рулонный'">
                            <label for="thickness" class="text-orange-600">Толщина листа</label>
                            <input v-model="thickness" type="number" id="thickness"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Толщина листа" required>
                        </div>
                        <div v-if="metal.data.title !== 'Лист'
                        && metal.data.title !== 'Лист просечно-вытяжной'
                        && metal.data.title !== 'Профлист'
                        && metal.data.title !== 'Лист рулонный'"
                        >
                            <label for="tonLength" class="text-orange-600">Длина тонны металлопроката</label>
                            <input v-model="tonLength" type="number" step="0.01" id="tonLength"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Длина тонны металлопроката" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"
                                   required>
                        </div>
                        <div
                            v-if="metal.data.title !== 'Труба' && metal.data.title !== 'Труба квадратная' && metal.data.title !== 'Круг'">
                            <label for="tonArea" class="text-orange-600">Площадь тонны металлопроката</label>
                            <input v-model="tonArea" type="number" step="0.01" id="tonArea"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Площадь тонны металлопроката" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"
                                   required>
                        </div>
                    </div>
                    <button @click.prevent="addCharacteristic" type="button"
                            class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500
                                            hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300
                                            dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        Создать
                    </button>
                </form>
            </div>
            <div v-if="updProduct"
                 :class="['relative bg bg-gray-200 overflow-x-auto shadow-md sm:rounded-lg w-full', this.hideUpdate ? '' : 'hidden']">
                <p class="p-2">Редактирование "{{ updProduct.title }}"</p>
                <div class="w-2/5 px-2 mx-2">
                    <label for="updTitle"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Наименование</label>
                    <input v-model="updTitle" id="updTitle"
                           class="bg-gray-50 h-9 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg
                                focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700
                                dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <button @click.prevent="updateCharacteristic" type="button"
                        class="ml-2 text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    Отправить
                </button>
                <button @click.prevent="closeUpdate" type="button"
                        class="text-white bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    Отмена
                </button>
            </div>
            <div :class="['ml-6', hideDelete ? '' : 'hidden']">
                <h1 class="italic mb-3">Удалить {{ this.delProduct.metal }} {{ this.delProduct.title }}?</h1>
                <div class="flex">
                    <button @click.prevent="deleteProduct" type="button"
                            class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600
                            hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300
                            dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80
                            font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        Удалить
                    </button>
                    <button @click.prevent="closeDelete" type="button"
                            class="text-white bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600
                            hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300
                            dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        Отмена
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import {Link} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

export default {

    name: "Index",

    layout: AuthenticatedLayout,

    components: {
        Link
    },

    data() {
        return {
            hideProduct: false,
            hideDelete: false,
            hideUpdate: false,
            mark: '',
            updTitle: '',
            size: null,
            second_size: null,
            diameter: null,
            wall: null,
            thickness: null,
            width: null,
            height: null,
            tonLength: null,
            tonArea: null,
            delProduct: '',
            updProduct: '',
        }
    },


    props: [
        'metals',
        'metal',
    ],

    methods: {

        addCharacteristic() {
            if (this.metal.data.title === 'Труба' || this.metal.data.title === 'Круг') {
                this.computedTonArea = this.diameter * Math.PI * this.tonLength / 1000
            } else if (this.metal.data.title === 'Труба квадратная') {
                this.computedTonArea = 2 * (this.height / 1000 + this.width / 1000) * this.tonLength
            } else {
                this.computedTonArea = this.tonArea
            }

            this.$inertia.post('/admin/characteristic', {
                metal_id: this.metal.data.id,
                mark: this.mark,
                width: this.width,
                height: this.height,
                wall: this.wall,
                size: this.size,
                second_size: this.second_size,
                thickness: this.thickness,
                diameter: this.diameter,
                ton_length: this.tonLength,

                ton_area: this.computedTonArea,
            })
            this.hideProduct = !this.hideProduct
            this.mark = null
            this.size = null
            this.second_size = null
            this.diameter = null
            this.width = null
            this.height = null
            this.wall = null
            this.thickness = null
            this.tonLength = null
            this.tonArea = null
        },

        showUpdate(product) {
            this.hideUpdate = !this.hideUpdate
            this.updProduct = product
            this.updTitle = product.title
        },

        updateCharacteristic() {
            this.$inertia.patch('/admin/characteristic/' + this.updProduct.id, {
                title: this.updTitle,
            });
            this.updProduct = ''
            this.hideUpdate = !this.hideUpdate
        },

        closeUpdate() {
            this.updProduct = ''
            this.hideUpdate = !this.hideUpdate
        },

        showDelete(product) {
            this.hideDelete = !this.hideDelete
            this.delProduct = product
        },

        deleteProduct() {
            this.$inertia.delete(route('characteristic.destroy', this.delProduct.id))
            this.delProduct = ''
            this.hideDelete = !this.hideDelete
        },

        closeDelete() {
            this.delProduct = ''
            this.hideDelete = !this.hideDelete
        },
    }
}
</script>

<style scoped>

</style>
