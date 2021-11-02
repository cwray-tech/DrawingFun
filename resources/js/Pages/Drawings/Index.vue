<template>
    <app-layout title="Drawings">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                All Name Drawings You're Organizing
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="
                        grid
                        border-2 border-black border-opacity-100
                        overflow-hidden
                    "
                >
                    <Link
                        :href="route('drawings.show', drawing)"
                        v-for="drawing in drawings"
                        :key="drawing.id"
                        class="p-6 hover:bg-white px-6 w-full block bg-white"
                    >
                        <h3 class="text-xl">{{ drawing.name }}</h3>
                    </Link>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
export default defineComponent({
    components: {
        AppLayout,
        Link,
    },
    props: ["drawings"],
});
</script>
