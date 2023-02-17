<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
import UserData from '@/Components/UserData.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
import UserPages from '@/Shared/Navigation/UserPages.vue';
import UserInfo from '@/Shared/User/UserInfo.vue';

const props = defineProps({
    user: Object,
})

</script>

<template>
    <UserLayout>
        <Breadcrumbs class="ml-5 mt-6" :pages="[['User', '/user'], ['Edit profile', '/user/edit']]" />

        <div class="flex justify-center content-center">
            <!-- <div class="container">
                                            <div class="flex-column">
                                                <UserInfo class="my-8" />
                                            </div>

                                        </div> -->
        </div>

    </UserLayout>
</template>