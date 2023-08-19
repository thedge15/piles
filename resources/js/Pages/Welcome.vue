<template>
    <div class="text-gray-100 font-[Poppins]">
        <nav class="fixed top-0 left-0 w-full py-6">
            <div class="container mx-auto flex justify-center">
                <ul class="text-sm tracking-wide items-center flex gap-x-8">
                    <li class="hover:scale-125 duration-300 py-1 hover:text-teal-400">
                        <a class="cursor-pointer">Home</a>
                    </li>
                    <li class="hover:scale-125 duration-300 py-1 hover:text-teal-400">
                        <a class="cursor-pointer">Product</a>
                    </li>
                    <li class="hover:scale-125 duration-300 py-1 hover:text-teal-400">
                        <a class="cursor-pointer">About us</a>
                    </li>
                    <li class="hover:scale-125 duration-300 py-1 hover:text-teal-400">
                        <a :href="route('index.elements')" class="cursor-pointer">Elements</a>
                    </li>
                    <a :href="route('openPage')">
                        <button class="bg-teal-600 px-7 rounded-full tracking-wide py-3 text-xs hover:scale-110 duration-300">
                            TO BUSHES
                        </button>
                    </a>
                </ul>
            </div>
        </nav>
        <section class="bg-[#23304c] mx-auto h-screen flex px-[10%] py-[6%]">
            <div class="flex-1 pt-7">
                <div class="absolute">
                    <h1 class="text-3xl leading-normal py-6">
                        Сount the paint <br/>
                        on the gas<br/>
                        bushes
                    </h1>
                    <a :href="route('openPage')">
                        <button
                            class="bg-teal-600 px-7 rounded-full tracking-wide py-3 text-xs hover:scale-110 duration-300">
                            TO BUSHES
                        </button>
                    </a>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "Welcome",
}
</script>
