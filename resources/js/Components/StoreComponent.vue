<template>
    <div :class="['shadow-md sm:rounded-lg ', this.hideMaterial ? '' : 'hidden']">
        <form class="p-4 bg-gray-200 mt-4">
            <div class="flex w-full">
                <div class="grid gap-6 mb-6 md:grid-cols-3">
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
        }
    },

    props: [
        'hideMaterial',
        'element',
        'elementTitle'
    ],

    methods: {

        addElement() {
            const obj = {
                title: this.title,
            };
            if (this.consumption) {
                obj.consumption = this.consumption
            }
            else if (this.steelStandard) {
                obj.steel_standard = this.steelStandard
            }
            this.$inertia.post(route(`store.${this.element}`), obj)
            this.title = ''
            if (this.steelStandard) {
                this.steelStandard = ''
            }
            else if (this.consumption) {
                this.consumption = null
            }
            this.$emit('closeStore')
        },

        closeStore() {
            this.$emit('closeStore')
        }
    }
}
</script>


<style scoped>

</style>
