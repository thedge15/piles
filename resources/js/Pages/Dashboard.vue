<template>
    <AuthenticatedLayout>
        <div class="flex flex-col h-screen py-5">
            <div v-if="bush" class="px-6 text-center font-bold">
<!--                <Link :href="route('dashboard')">-->
<!--                    КГС {{ bush.data.title }}-->
<!--                </Link>-->
            </div>
            <div class="flex flex-col h-screen py-5">
                <!-- component -->
                <div class="flex-grow overflow-auto">
                    <table class="relative w-full border mb-3">
                        <thead>
                        <tr>
                            <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">№</th>
                            <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Наименование куста</th>
                            <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Просмотр</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y bg-gray-100">
                        <tr v-for="(bush, index) in bushes">
                            <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ index + 1 }}</td>
                            <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ bush.title }}</td>
                            <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                                <Link :href="route('user.index', bush.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor" class="w-6 h-6 mx-auto cursor-pointer">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </Link>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {

    name: "Dashboard",

    layout: AuthenticatedLayout,

    data() {
        return {
            bush: this.bush,
            hideBush: false,
            title: '',
            body: '',
        }
    },


    components: {
        Link
    },

    props: [
        'bushes',
    ],

}
</script>

<style scoped>

</style>
