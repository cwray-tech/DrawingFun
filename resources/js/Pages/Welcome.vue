<template>
    <Head title="Create a Drawing" />

    <div
        class="
            relative
            flex
            items-top
            justify-center
            min-h-screen
            bg-white
            dark:bg-gray-900
            sm:items-center sm:pt-0
        "
    >
        <div
            v-if="canLogin"
            class="hidden fixed top-0 right-0 px-6 py-4 sm:block"
        >
            <Link
                v-if="$page.props.user"
                :href="route('drawings.index')"
                class="text-sm text-gray-700 underline"
            >
                Drawings
            </Link>

            <template v-else>
                <Link
                    :href="route('login')"
                    class="text-sm text-gray-700 underline"
                >
                    Log in
                </Link>

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ml-4 text-sm text-gray-700 underline"
                >
                    Register
                </Link>
            </template>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl mb-6">Create a Drawing!</h1>
            <form @sumbit.prevent="createDrawing" class="grid gap-4">
                <div>
                    <jet-label for="drawing_name" class="text-center text-lg"
                        >Give your Drawing a name.</jet-label
                    >
                    <jet-input
                        id="drawing_name"
                        type="text"
                        v-model="form.drawing_name"
                        placeholder="eg. Wray Family Christmas Drawing"
                        required
                    />
                </div>

                <jet-button
                    class="text-center"
                    @click.prevent="createDrawing"
                    type="submit"
                    >Create Drawing!</jet-button
                >
            </form>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import JetInput from "@/Jetstream/Input";
import JetLabel from "@/Jetstream/Label";
import JetButton from "@/Jetstream/Button";

export default defineComponent({
    components: {
        Head,
        Link,
        JetInput,
        JetLabel,
        JetButton,
    },
    data() {
        return {
            form: this.$inertia.form({
                drawing_name: "",
            }),
        };
    },

    props: {
        canLogin: Boolean,
        canRegister: Boolean,
    },

    methods: {
        createDrawing() {
            this.form.post(route("drawings.store"));
        },
    },
});
</script>
