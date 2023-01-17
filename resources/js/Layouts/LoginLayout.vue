<script setup>
import { AppLogo } from '@/Shared/Icons/Icons'
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="flex items-center justify-center w-full">
            <AppLogo class="h-20 w-20 fill-cyan-400"/>
            <span class="text-6xl">FILR</span>
        </div>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg border-2 border-gray-800">
            <slot />
        </div>
    </div>
</template>
