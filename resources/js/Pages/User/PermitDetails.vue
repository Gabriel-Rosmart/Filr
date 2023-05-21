<script setup>
    import UserLayout from '@/Layouts/UserLayout.vue';
    import AdminLayout from '@/Layouts/AdminLayout.vue'
    import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
    import PermitFurther from '@/Shared/User/PermitFurther.vue';
    import { Head } from '@inertiajs/inertia-vue3';

    import { useI18n } from 'vue-i18n';

    const props = defineProps({
        isAdmin: Number,
        permit: Object
    })

    const { t } = useI18n();
</script>

<template>
    <Head title="Permit request" />

    <component :is="isAdmin == 0 ? UserLayout : AdminLayout">
        <Breadcrumbs v-if="isAdmin == 0" class="ml-5 mt-6"
            :pages="[[t('breadcrumbs.user'), '/user'], [t('breadcrumbs.permitDetails'), '/user/permit?uuid=' + permit.uuid]]" />
        <Breadcrumbs v-else-if="isAdmin == 1" class="ml-5 mt-6"
            :pages="[['Admin', '/admin'], [t('breadcrumbs.dashboard'), '/admin']]" />
        <div class="flex justify-center content-center mt-4">
            <div class="flex flex-col mt-10 mx-20 w-full">
                <PermitFurther :permit="permit"/>
            </div>
        </div>
        
    </component>

</template>