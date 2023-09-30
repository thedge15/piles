<script setup>
import {Link} from "@inertiajs/vue3";
const props = defineProps({
    project: Object,
})
</script>
<template>
    <Link :href="route('export', project.id)"
            class="mb-2 mr-2 px-3 py-2.5 w-1/12 text-white text-center bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600
                        hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300
                        font-medium rounded-lg text-sm">
       Экспорт
    </Link>
</template>

