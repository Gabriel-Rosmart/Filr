<script setup>
import { AppLogo } from '@/Shared/Icons/Icons'
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
