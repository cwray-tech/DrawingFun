<template>
    <app-layout :title="drawing.name">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ drawing.name }}
            </h2>
        </template>

        <div class="py-12">
            <div
                class="
                    max-w-7xl
                    mx-auto
                    sm:px-6
                    lg:px-8
                    grid grid-cols-2
                    gap-40
                "
            >
                <div
                    class="
                        border-4 border-black border-opacity-100
                        bg-white
                        divide-y-2 divide-black
                    "
                >
                    <h2 class="p-6 text-xl">Drawing Invitees</h2>

                    <div
                        class="p-6 grid grid-cols-2 gap-4"
                        v-for="invitee in drawing.invitees"
                        :key="invitee.id"
                    >
                        <jet-input
                            @change="updateInvitee(invitee)"
                            type="text"
                            :placeholder="invitee.name"
                            v-model="invitee.name"
                        ></jet-input>
                        <jet-input
                            @change="updateInvitee(invitee)"
                            type="email"
                            :placeholder="invitee.email"
                            v-model="invitee.email"
                        ></jet-input>
                    </div>
                </div>

                <div class="mx-auto justify-self-center max-w-screen-sm w-full">
                    <h2 class="p-6 text-xl text-center">
                        Now, add invitees to the drawing..
                    </h2>
                    <form class="grid gap-4">
                        <div>
                            <jet-label for="name" class="text-lg"
                                >Person Info</jet-label
                            >
                            <jet-input
                                id="name"
                                type="text"
                                v-model="invitee.name"
                                placeholder="Name"
                                required
                            />
                        </div>
                        <div>
                            <jet-input
                                id="email"
                                type="email"
                                v-model="invitee.email"
                                placeholder="Email"
                                required
                            />
                        </div>

                        <jet-button
                            class="text-center mx-auto"
                            @click.prevent="addInvitee"
                            type="submit"
                            >Add invitee!</jet-button
                        >
                    </form>

                    <div
                        v-if="drawing.invitees.length > 1"
                        class="mt-20 flex flex-col"
                    >
                        <h2 class="p-6 text-xl text-center">
                            When you're ready, invite the participants to name
                            draw!
                        </h2>
                        <jet-button
                            @click="inviteParticipants"
                            class="text-center mx-auto"
                            >Invite participants to name draw!</jet-button
                        >
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetButton from "@/Jetstream/Button.vue";

export default defineComponent({
    props: ["drawing"],

    components: {
        AppLayout,
        JetInput,
        JetLabel,
        JetButton,
    },
    data() {
        return {
            invitee: this.$inertia.form({
                name: "",
                email: "",
            }),
        };
    },
    methods: {
        updateInvitee(invitee) {
            this.$inertia.patch(
                this.route("drawings.invitees.update", [this.drawing, invitee]),
                invitee
            );
        },
        addInvitee() {
            this.invitee.post(route("drawings.invitees.store", this.drawing), {
                onSuccess: () => {
                    this.invitee.reset();
                },
            });
        },
        inviteParticipants() {
            this.$inertia.post(route("drawings.invitees.invite", this.drawing));
        },
    },
});
</script>
