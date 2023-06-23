<template>
    <body class="relative bg-gray-100 overflow-hidden max-h-screen">
    <header class="fixed right-0 top-0 border-gray-300 left-60 bg-gray-100 py-3 px-4 h-16 mx-auto">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-center">
                <div class="text-lg font-bold">Сваи</div>
                <div>
                    <Link href="#" type="button"
                          class="flex pl-12 items-center focus:outline-none rounded-lg text-gray-600 hover:text-yellow-600 focus:text-yellow-600 font-semibold p-2 border border-transparent hover:border-yellow-300 focus:border-yellow-300 transition">
                        <span class="text-sm"><Link :href="route('dashboard')">К сваям</Link>></span>
                    </Link>
                </div>
            </div>
        </div>
    </header>

    <slot/>
    </body>
</template>

<script>

import {Link} from "@inertiajs/vue3";

export default {

    name: "AdminLayout",

    components: {
        Sidebar,
        Link,
    },
}
</script>

<style scoped>
/* Only the scroll bar */
::-webkit-scrollbar {
    width: .5rem;
    height: .5rem;
}

::-webkit-scrollbar-thumb {
    background: rgba(0, 0, 0, .15);
}

::-webkit-scrollbar-thumb:hover {
    background: rgba(0, 0, 0, .3);
}
</style>
