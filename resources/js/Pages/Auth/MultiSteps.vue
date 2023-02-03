<template>
    <AdminLayout>
        <Breadcrumbs class="ml-5 mt-6"
            :pages="[['Admin', '/admin'], ['Manage Users', '/admin/manage'], ['Register', '/admin/manage/register']]" />
        <div class="w-full min-h-full flex flex-col sm:justify-center items-center sm:pt-0">
            <div class="p-5 min-h-full">
                <div class="my-6">
                    <h2 class="mb-12 text-center text-5xl font-extrabold">New User</h2>
                </div>
                <div class="flex flex-col items-center">
                    <component v-bind:is="step[currentStep].component" />
                </div>
                <div class="flex gap-2 justify-end mx-7">
                    <div class="mt-6">
                        <button class="btn btn-outline btn-primary" v-if="currentStep !== 0" v-on:click="previous">Anterior</button>
                    </div>
                    <div class="mt-6">
                        <button class="btn btn-outline btn-primary" v-if="currentStep < step.length - 1" v-on:click="next">Next</button>
                    </div>
                    <div class="mt-6">
                        <button class="btn btn-primary" v-if="currentStep == step.length - 1">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script>
import About from '@/Components/Steps/About.vue';
import Information from '@/Components/Steps/Information.vue';
import Profile from '@/Components/Steps/Profile.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';

export default {
    name: "MultiSteps",
    data() {
        return {
            currentStep: 0,
            step: [
                {
                    component: Information
                },
                {
                    component: About
                },
                {
                    component: Profile
                },
            ]
        };
    },
    methods: {
        next() {
            this.currentStep += 1;
        },
        previous() {
            this.currentStep -= 1;
        }
    },
    components: [
        Information,
        About,
        Profile
    ],
    components: { AdminLayout, Breadcrumbs }
}
</script>