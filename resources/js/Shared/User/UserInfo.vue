<script setup>

    /** Function imports */
    import { ref } from 'vue'
    import  appconfig  from '@/appconfig';

const props = defineProps({
    user: Object
})

    const storage = ref(appconfig.STORAGE_URL)

</script>


<template>
    <div class="flex justify-start">
        <div class="avatar">
            <div class="w-24 rounded-full">
                <img :src="storage + user.profile_pic" />
            </div>
        </div>
        <div class="ml-5 mt-3">
            <div class="flex gap-4 items-end">
                <span class="text-5xl">{{ user.name }}</span>
            </div>
            <div class="mt-2">
                <span>
                    {{ user.email }}
                </span>
            </div>
        </div>
    </div>
</template>