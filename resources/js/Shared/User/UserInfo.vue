<script setup>

import { ref } from 'vue'

const props = defineProps({
    user: Array
})

const storage = ref('/storage/')
const defautAvatar = ref('prof.jpg')

</script>


<template>
    <div class="flex justify-start">
        <div class="avatar">
            <div class="w-24 rounded-full">
                <img :src="storage + (user[0].profile_pic ?? defautAvatar)" />
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