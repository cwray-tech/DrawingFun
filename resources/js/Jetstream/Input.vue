<template>
    <input
        class="
            w-full
            mt-2
            border-gray-300
            focus:border-black focus:ring focus:ring-black focus:ring-opacity-50
            rounded-md
            shadow-sm
        "
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    />
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    props: ["modelValue", "label"],

    emits: ["update:modelValue"],

    methods: {
        focus() {
            this.$refs.input.focus();
        },
    },
});
</script>
