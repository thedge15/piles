<template>
    <button @click.prevent="closeStore" type="button"
            class="mb-2 w-1/12 text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600
                        hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300
                        font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2">
        Создать
    </button>
</template>

<script>
export default {
    name: "CreateButton",

    methods: {
        closeStore() {
            this.$emit('closeStore')
        }
    }
}
</script>

<style scoped>

</style>
