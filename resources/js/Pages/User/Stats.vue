<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
import UserPages from '@/Shared/Navigation/UserPages.vue';
import UserInfo from '@/Shared/User/UserInfo.vue';

</script>

<template>
    <UserLayout>
        <Breadcrumbs class="ml-5 mt-6" :pages="[['User', '/user'], ['Stats', '/user/stats']]" />

        <div class="flex justify-center content-center">
            <div class="container">
                <div class="flex-column">
                    <UserInfo class="my-8" />
                    <UserPages :activePage="'Stats'" class=" mt-2 mb-8" />

                </div>

            </div>
        </div>

    </UserLayout>
</template>