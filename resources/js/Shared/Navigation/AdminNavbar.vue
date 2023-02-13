<script setup>
    /** Icon imports */
    import { HomeIcon, ManageUsersIcon, FileIcon, ArchiveIcon, AppLogo } from '../Icons/Icons';

    /** Component imports */
    import NotificationDropdown from './NotificationDropdown.vue';
    import ThemeToggle from './ThemeToggle.vue'
    import { Link } from '@inertiajs/inertia-vue3';
    import LanguageDropdown from './LanguageDropdown.vue';
    import AvatarDropdown from '@/Shared/Navigation/AvatarDropdown.vue'
    import { useI18n } from 'vue-i18n'

    const { t } = useI18n()
</script>

<template>
    <div class="navbar bg-base-100 border-b-2 border-brown-50 dark:border-gray-800">
        <div class="navbar-start">
            <div class="dropdown">
                <label tabindex="0" class="btn btn-ghost btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </label>
                <ul tabindex="0"
                    class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                    <li>
                        <Link href="/admin">
                            <HomeIcon/>
                            {{ t('admin.navbar.dropdown.dashboard') }}
                        </Link>
                    </li>
                    <li>
                        <Link href="/admin/manage">
                            <ManageUsersIcon/>
                            {{ t('admin.navbar.dropdown.users') }}
                        </Link>
                    </li>
                    <li>
                        <Link href="/admin/permits">
                            <FileIcon/>
                            {{ t('admin.navbar.dropdown.permits') }}
                        </Link>
                    </li>
                    <li>
                        <Link href="/admin/incidences">
                            <ArchiveIcon/>
                            {{ t('admin.navbar.dropdown.incidences') }}
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
        <div class="navbar-center">
            <a class="btn btn-ghost normal-case text-xl"><AppLogo class="w-6 fill-cyan-400"/></a>
        </div>
        <div class="navbar-end">
            <LanguageDropdown/>
            <ThemeToggle/>
            <NotificationDropdown/>
            <AvatarDropdown/>
        </div>
    </div>
</template>