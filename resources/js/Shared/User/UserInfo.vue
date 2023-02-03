<script setup>

    /** Function imports */
    import { ref } from 'vue'

    /** Config imports */
    import appconfig from '@/appconfig';

    const props = defineProps({
        user: Array
    })

    const storage = ref(appconfig.STORAGE_URL)

</script>


<template>
    <div class="flex justify-start">
        <div class="avatar">
            <div class="w-24 rounded-full">
                <img :src="storage + user[0].profile_pic" />
            </div>
        </div>
        <div class="ml-5 mt-3">
            <div class="flex gap-4 items-end">
                <span class="text-5xl">{{ user[0].name }}</span>
            </div>
            <div class="mt-2">
                <span>
                    {{ user[0].email }}
                </span>
            </div>
        </div>
    </div>
</template>