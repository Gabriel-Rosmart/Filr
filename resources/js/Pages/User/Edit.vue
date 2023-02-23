<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
import UserData from '@/Components/UserData.vue';
import Breadcrumbs from '@/Shared/Navigation/Breadcrumbs.vue';
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    user: Object,
    isAdmin: Number
})

const form = useForm({
    id: props.user.id,
    name: props.user.name,
    dni: props.user.dni,
    telephone: props.user.phone,
    email: props.user.email,
})

</script>

<template>
    <UserLayout>
        <Breadcrumbs class="ml-5 mt-6" :pages="[['User', '/user'], ['Edit profile', '/user/edit']]" />

        <div class="flex justify-center content-center">
            <form @submit.prevent="" class="w-full pr-10">
                <UserData :user="user" :form="form" :isAdmin="isAdmin" />
                <div class="flex justify-center mt-8">
                    <button class="btn btn-outline btn-error mr-4">Cancel</button>
                    <button class="btn btn-outline btn-success" @click="submit">Save</button>
                </div>
            </form>
        </div>

    </UserLayout>
</template>