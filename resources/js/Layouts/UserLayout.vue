<template>
    <div :class="['max-h-screen', this.hideSidebar ? '' : 'ml-60']">
        <div class="bg-gray-100">
            <guest-sidebar :class="[this.hideSidebar ? 'hidden' : '']"></guest-sidebar>
            <!-- Page Content -->
            <main>
                <main class="max-h-screen overflow-auto bg-gray-100">

                    <div class="px-6">
                        <div class="flex flex-col h-screen pb-5">
                        <div>
                            <button @click.prevent="this.hideSidebar = !this.hideSidebar" type="button" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500
                            to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300
                            dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-1.5 text-center mr-2
                            mt-2">{{this.hideSidebar ? 'Показать сайдбар' : 'Скрыть сайдбар'}}</button>
                        </div>
                            <slot />
                        </div>
                    </div>
                </main>
            </main>
        </div>
    </div>
</template>


<script>
import GuestSidebar from "@/Components/GuestSidebar.vue";

export default {

    components: {
        GuestSidebar
    },

    data() {
        return {
            hideSidebar: false,
        }
    }
}

</script>

<style>
label {
    margin-bottom: 2px;
    color: #2d3748;
    font-size:.875rem;
    line-height:1.25rem;
    font-weight: 500;
    display:block;
}
select {
    border-radius:.5rem;
    width: 100%;
    display:block;
    background-color: rgb(249 250 251);
    margin-bottom:.5rem;
    height:2rem;
    color: rgb(17 24 39);
    font-size: 0.875rem; /* 14px */
    line-height: 1.25rem; /* 20px */
}
input {
    border-radius:.5rem;
    width: 100%;
    display:block;
    background-color: rgb(249 250 251);
    margin-bottom:.5rem;
    height:2rem;
    color: rgb(17 24 39);
    font-size: 0.875rem; /* 14px */
    line-height: 1.25rem; /* 20px */
}
button {
    border-radius:.5rem
}
th {
    position: sticky;
    top:0;
    padding: .5rem;
    color: rgb(224 231 255);
    background-color: rgb(99 102 241);
}


</style>
