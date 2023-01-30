<script setup>

defineProps({
    user: Array
})


</script>


<template>
    <div class="flex justify-start">
        <div class="avatar online">
            <div class="w-24 rounded-full">
                <img src="userData.image" />
            </div>
        </div>
        <div class="ml-5 mt-3">
            <div class="flex gap-4 items-end">
                <span class="text-5xl">{{ console }}</span>
            </div>
            <div>
                <span>
                    &lt {{  }} &gt
                </span>
            </div>

        </div>
    </div>


</template>