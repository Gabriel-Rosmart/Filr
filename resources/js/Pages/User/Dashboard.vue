<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
import UserPages from '@/Shared/Navigation/UserPages.vue'

</script>

<template>
    <UserLayout>
        <Breadcrumbs class="ml-5 mt-6" :pages="['User', 'Dashboard']" />
        <div class="flex justify-center content-center">
            <UserPages :activePage="'Dashboard'"/>
        </div>
    </UserLayout>
</template>