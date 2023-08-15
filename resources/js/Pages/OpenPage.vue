<template>
    <p class="text-center italic">КГС</p>
    <div v-if="$page.props.auth.user['is_admin'] === 1">
        <CreateButton @closeStore="closeStore"></CreateButton>
    </div>
    <div class="flex-grow overflow-auto">
        <table class="relative w-full border mb-3">
            <thead>
            <tr>
                <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">№</th>
                <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Наименование куста</th>
                <th class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Просмотр</th>
                <th v-if="$page.props.auth.user['is_admin'] === 1"
                    class="sticky top-0 px-6 py-3 text-indigo-100 bg-indigo-500">Удаление
                </th>
            </tr>
            </thead>
            <tbody class="divide-y bg-gray-100">
            <tr v-for="(item, index) in bushes">
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ index + 1 }}</td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>{{ item.title }}</td>
                <td :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <Link :href="route('user.index', item.id)"><ShowButton></ShowButton></Link>
                </td>
                <td v-if="$page.props.auth.user['is_admin'] === 1"
                    :class='["px-6 py-2 text-center", index%2 === 0 ? "" : "bg-gray-300"]'>
                    <DeleteButton @showDelete="showDelete" :item="item"></DeleteButton>
                </td>
            </tr>
            </tbody>
        </table>
        <StoreComponent :hide-material="this.hideMaterial" :element="'bush'" :element-title="'куста'"
                        @closeStore="closeStore"></StoreComponent>
        <DeleteComponent :del-element="this.delElement" :hide-delete="this.hideDelete" :del-title="'bush'"
                         @closeDelete="closeDelete"></DeleteComponent>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import UserLayout from "@/Layouts/UserLayout.vue";
import DeleteComponent from "@/Components/DeleteComponent.vue";
import StoreComponent from "@/Components/StoreComponent.vue";
import CreateButton from "@/Components/CreateButton.vue";
import DeleteButton from "@/Components/DeleteButton.vue";
import mixin from "@/mixins/mixin";
import ShowButton from "@/Components/ShowButton.vue";

export default {
    name: "OpenPage",

    layout: UserLayout,

    components: {
        ShowButton,
        DeleteButton,
        CreateButton,
        StoreComponent,
        DeleteComponent,
        Link
    },

    props: [
        'bushes',
    ],

    mixins: [
        mixin
    ],
}
</script>

