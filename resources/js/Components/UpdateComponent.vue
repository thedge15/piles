<template>
    <div v-if="updProduct"
         :class="['relative bg bg-gray-200 overflow-x-auto shadow-md sm:rounded-lg w-full', this.hideUpdate ? '' : 'hidden']">
        <p class="p-2">Редактирование "{{ updProduct.title }}"</p>
        <div class="w-2/5 px-2 mx-2">
            <label for="updTitle"
                   class="block mb-2 text-sm font-medium text-gray-900">Наименование</label>
            <input v-model="updProduct.title" id="updTitle"
                   class="bg-gray-50 h-9 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg
                                focus:ring-blue-500 focus:border-blue-500 block w-full">
        </div>
        <button @click.prevent="updateProduct" type="button"
                class="ml-2 text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br
                    focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5
                    py-2.5 text-center mr-2 mb-2">
            Отправить
        </button>
        <button @click.prevent="closeUpdate" type="button"
                class="text-white bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 hover:bg-gradient-to-br
                    focus:ring-4 focus:outline-none focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-2.5
                    text-center mr-2 mb-2">
            Отмена
        </button>
    </div>
</template>

<script>
export default {
    name: "UpdateComponent",

    props: [
        'hideUpdate',
        'updProduct',
        'element',
    ],

    methods: {

        updateProduct() {
            this.$inertia.patch(route(`update.${this.element}`, this.updProduct.id), {
                title: this.updProduct.title,
            });
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
