<template>
    <div>
        <div class="px-6">
            <div v-for="bush in bushes">
                <p>
                    Bush::create([
                    'title' => '{{ bush.title }}',
                    ])
                </p>
            </div>
        </div>
        <div class="px-6">
            <div v-for="item in projects">
                <p>Project::create(['bush_id' => {{ item.bush_id }}, 'title' => '{{ item.title }}', 'change' =>
                    {{ item.change }}])</p>
            </div>
        </div>
        <div class="px-6">
            <div v-for="item in elements">
                <p>Element::create(['title' => '{{ item.title }}'])</p>
            </div>
        </div>
        <div class="px-6">
            <div v-for="item in metals">
                <p>Metal::create(['title' => '{{ item.title }}'])</p>
            </div>
        </div>
        <div class="px-6">
            <div v-for="material in materials">
                <p>
                    Material::create([
                    'numb' => '{{ material.numb }}',
                    'project_id' => '{{ material.project_id }}',
                    'metal_id' => '{{ material.metal_id }}',
                    'characteristic_id' => '{{ material.characteristic_id }}',
                    <span v-if="material.element">'element' => '{{ material.element }}',</span>
                    'title' => '{{ material.title }}',
                    'weight' => '{{ material.weight }}',
                    <span v-if="material.length">'length' => '{{ material.length }}',</span>
                    'area' => '{{ material.area }}',
                    <span v-if="material.quantity">'quantity' => '{{ material.quantity }}',</span>
                    'paint' => '{{ material.paint }}',
                    'paint_quantity' => '{{ material.paint_quantity }}',
                    'paint_color' => '{{ material.paint_color }}',
                    'number_of_layers' => '{{ material.number_of_layers }}',
                    'is_pile' => '{{ material.is_pile }}',
                    ])
                </p>
            </div>
        </div>
        <div class="px-6">
            <div v-for="item in characteristics">
                <p>Characteristic::create([
                    'metal_id' => '{{ item.metal_id }}',
                    'title' => '{{ item.title }}', <span
                    v-if="item.ton_length">'ton_length' => {{ item.ton_length }},
                    </span>'ton_area' => {{ item.ton_area }}])</p>
            </div>
        </div>
        <div class="px-6">
            <div v-for="item in standards">
                <p>Standard::create(['metal_id' => {{ item.metal_id }}, 'title' => '{{ item.title }}'])</p>
            </div>
        </div>
        <div class="px-6">
            <div v-for="item in steels">
                <p>Steel::create(['title' => '{{ item.title }}'])</p>
            </div>
        </div>
        <div class="px-6">
            <div v-for="item in paints">
                <p>Paint::create(['title' => '{{ item.title }}', 'consumption' => '{{ item.consumption }}'])</p>
            </div>
        </div>
    </div>
</template>

<script>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {

    name: "All",

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
        'elements',
        'paints',
    ],
}

</script>
