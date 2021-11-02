<template>
    <Head title="Draw your name" />
    <div
        class="
            relative
            flex
            items-top
            justify-center
            min-h-screen
            bg-white
            dark:bg-gray-900
            sm:items-center
            py-12
        "
    >
        <div class="max-w-screen-sm mx-auto px-6 lg:px-8">
            <h1 class="text-3xl mb-6 text-center">{{ drawing.name }}</h1>
            <h2 class="text-xl mb-6 text-center">
                Hey {{ invitee.name }}!
                {{ giving_to ? "" : "Welcome to the " + drawing.name + "." }}
            </h2>
            <div v-if="!giving_to">
                <p class="text-lg text-center mb-6">
                    {{
                        is_drawing
                            ? "Drawing your name!"
                            : "Click the button to draw your name."
                    }}
                </p>
                <form class="grid gap-4">
                    <jet-button
                        :class="[
                            'text-center mx-auto',
                            is_drawing ? 'blinking' : '',
                        ]"
                        @click.prevent="draw"
                        type="submit"
                        >{{
                            is_drawing ? "Drawing your name!" : "Draw a name!"
                        }}</jet-button
                    >
                </form>

                <div class="mt-6 p-6 border-2 border-black opacity-100">
                    <p
                        class="p-4 text-center"
                        v-for="invite in available"
                        :key="invite.id"
                    >
                        {{ invite.name }}
                    </p>
                    <p class="p-4 text-center" v-if="available.length < 1">
                        Charity
                    </p>
                </div>
            </div>
            <p class="text-lg text-center" v-else>
                You are giving a gift to
                {{
                    giving_to.id == invitee.id
                        ? "whomever you want! Since there was an odd number of people in your exchange, you get to choose whoever you want to give a gift to."
                        : giving_to.name + "!"
                }}
            </p>
        </div>
    </div>
    <div class="wrapper" v-if="giving_to">
        <div v-for="i in 149" :key="i" :class="'confetti-' + i"></div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import JetButton from "@/Jetstream/Button";

export default defineComponent({
    props: ["drawing", "invitee"],
    components: {
        Head,
        Link,
        JetButton,
    },
    data() {
        return {
            is_drawing: false,
            giving_to: this.invitee.receiver ? this.invitee.receiver : null,
            available: this.drawing.available_invitees.filter(
                (invitee) => invitee.id !== this.invitee.id
            ),
        };
    },

    methods: {
        draw() {
            this.is_drawing = true;
            this.giving_to =
                this.available.length > 0
                    ? this.available[
                          Math.floor(Math.random() * this.available.length)
                      ]
                    : this.invitee;
            this.$inertia.post(
                route("draw.store", [this.drawing, this.invitee]),
                {
                    giving_to: this.giving_to.id,
                    perserveState: false,
                }
            );
            this.is_drawing = false;
        },
    },
});
</script>

<style lang="scss" scoped>
//Confetti
body {
    margin: 0;
    overflow: hidden;
}

.wrapper {
    position: fixed;
    overflow: hidden;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    min-height: 100vh;
}

[class|="confetti"] {
    position: absolute;
}

$colors: (#d13447, #ffbf00, #263672);

@for $i from 0 through 150 {
    $w: random(8);
    $l: random(100);
    .confetti-#{$i} {
        width: #{$w}px;
        height: #{$w * 0.4}px;
        background-color: nth($colors, random(3));
        top: -10%;
        left: unquote($l + "%");
        opacity: random() + 0.5;
        transform: rotate(#{random() * 360}deg);
        animation: drop-#{$i}
            unquote(4 + random() + "s")
            unquote(random() + "s")
            infinite;
    }

    @keyframes drop-#{$i} {
        100% {
            top: 110%;
            left: unquote($l + random(15) + "%");
        }
    }
}
</style>
