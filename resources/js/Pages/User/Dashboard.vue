<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
import UserPages from '@/Shared/Navigation/UserPages.vue';
import UserInfo from '@/Shared/User/UserInfo.vue';
import TimeTable from '@/Shared/Info/TimeTable.vue';

</script>

<template>
    <UserLayout>
        <Breadcrumbs class="ml-5 mt-6" :pages="[['User', '/user'], ['Dashboard', '/user']]" />

        <div class="flex justify-center content-center">
            <div class="container">
                <div class="flex-column">
                    <UserInfo class="my-8" />
                    <UserPages :activePage="'Dashboard'" class=" mt-2 mb-8" />
                    <TimeTable class="my-8" />
                </div>

            </div>
        </div>

    </UserLayout>
</template>