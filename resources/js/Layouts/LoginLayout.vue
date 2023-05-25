<script setup>
import ThemeToggle from '@/Shared/Navigation/ThemeToggle.vue'
import LanguageDropdown from '@/Shared/Navigation/LanguageDropdown.vue';
import { AppLogo } from '@/Shared/Icons/Icons'
</script>

<template>
    <div class="flex flex-row items-center max-h-0">
        <div class="flex flex-row w-full justify-end mt-16
         bg-base-100 dark:border-gray-800">
            <LanguageDropdown />
            <ThemeToggle/>
        </div>
    </div>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="flex items-center justify-center w-full">
            <AppLogo class="h-20 w-20 fill-cyan-400"/>
            <span class="text-6xl">FILR</span>
        </div>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg border-2 dark:border-gray-800">
            <slot />
        </div>
    </div>
</template>
