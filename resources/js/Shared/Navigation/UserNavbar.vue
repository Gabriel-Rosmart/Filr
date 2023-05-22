<script setup>
import { CalendarIcon, ClockIcon, AppLogo, FileIcon, ArchiveIcon, WarningIcon } from '../Icons/Icons';
import ThemeToggle from './ThemeToggle.vue'
import { Link } from '@inertiajs/inertia-vue3';
import AvatarDropdown from '@/Shared/Navigation/AvatarDropdown.vue'
import LanguageDropdown from './LanguageDropdown.vue';
import { useI18n } from 'vue-i18n'

const { t } = useI18n();

</script>

<template>
    <div class="navbar bg-base-100 border-b-2 border-brown-50 dark:border-gray-800">
        <div class="navbar-start">
            <div class="dropdown">
                <label tabindex="0" class="btn btn-ghost btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </label>
                <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                    <li>
                        <Link href="/user?component=0">
                        <CalendarIcon />
                        {{t('admin.details.timetable')}}
                        </Link>
                    </li>
                    <li>
                        <Link href="/user?component=1">
                        <ClockIcon />
                        {{t('admin.details.files')}}
                        </Link>
                    </li>
                    <li>
                        <Link href="/user?component=2">
                        <ArchiveIcon />
                        {{t('admin.details.permits')}}
                        </Link>
                    </li>
                    <li>
                        <Link href="/user?component=3">
                        <WarningIcon/>
                        {{t('admin.details.incidences')}}
                        </Link>
                    </li>
                    <li>
                        <Link href="/user/permitreq">
                        <FileIcon />
                        {{ t('admin.navbar.avatar.permit') }}
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
        <div class="navbar-center">
            <a class="btn btn-ghost normal-case text-xl" href="/user">
                <AppLogo class="w-6 fill-cyan-400" />
            </a>
        </div>
        <div class="navbar-end">
            <LanguageDropdown />
            <ThemeToggle />
            <!-- <NotificationDropdown /> -->
            <AvatarDropdown />
        </div>
    </div>
</template>