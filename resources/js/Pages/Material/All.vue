<template>
    <div>
        <!--        <div class="px-6">-->
        <!--            <div v-for="material in materials">-->
        <!--&lt;!&ndash;                <p>{{ material }}</p>&ndash;&gt;-->
        <!--                <p>-->
        <!--                    Material::create([-->
        <!--                    'project_id' => '{{ material.project_id }}',-->
        <!--                    'metal_id' => '{{ material.metal_id }}',-->
        <!--                    'title' => '{{ material.title }}',-->
        <!--                    <span v-if="material.quantity">'quantity' => '{{ material.quantity }}',</span>-->
        <!--                    'weight' => '{{ material.weight }}',-->
        <!--                    <span v-if="material.length">'length' => '{{ material.length }}',</span>-->
        <!--                    'area' => '{{ material.area }}',-->
        <!--                    <span v-if="material.element">'element' => '{{ material.element }}',</span>-->
        <!--                    -->
        <!--                    ])-->
        <!--                </p>-->
        <!--            </div>-->
        <!--        </div>-->
<!--        <div class="px-6">-->
<!--            <div v-for="item in characteristics">-->
<!--                <p>Characteristic::create(['metal_id' => '{{ item.metal_id }}', 'title' => '{{ item.title }}', <span-->
<!--                    v-if="item.ton_length">'ton_length' => {{ item.ton_length }}, </span>'ton_area' => {{-->
<!--                        item.ton_area-->
<!--                    }}])</p>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="px-6">-->
<!--            <div v-for="item in elements">-->
<!--                <p>Element::create(['project_id' => '{{ item.project_id }}', 'title' => '{{ item.title }}']</p>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="px-6">-->
<!--            <div v-for="item in projects">-->
<!--                <p>Project::create(['bush_id' => {{ item.bush_id }}, 'title' => '{{ item.title }}', 'change' => {{ item.change }}])</p>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="px-6">-->
<!--            <div v-for="item in standards">-->
<!--                <p>Standard::create(['metal_id' => {{ item.metal_id }}, 'title' => '{{ item.title }}'])</p>-->
<!--            </div>-->
<!--        </div>-->
        <div class="px-6">
            <div v-for="item in steels">
                <p>Steel::create(['title' => '{{ item.title }}'])</p>
            </div>
        </div>
    </div>
</template>

<script>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {

    name: "Index",


    data() {
        return {}
    },

    layout: AuthenticatedLayout,

    components: {
        Link
    },

    props: [
        'bushes',
        'projects',
        'materials',
        'metals',
        'characteristics',
        'standards',
        'standardTypes',
        'steels',
        'units',
        'elements',
        'paints',
    ]

}

</script>

<style scoped>

</style>
