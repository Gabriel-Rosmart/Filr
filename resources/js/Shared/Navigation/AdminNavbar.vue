<script setup>
    import { HomeIcon, ManageUsersIcon, SettingsIcon, AppLogo } from '../Icons/Icons';
    import NotificationDropdown from './NotificationDropdown.vue';
    import ThemeToggle from './ThemeToggle.vue'
    import { Link } from '@inertiajs/inertia-vue3';
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
                        <Link>
                            <HomeIcon/>
                            Dashboard
                        </Link>
                    </li>
                    <li>
                        <Link>
                            <ManageUsersIcon/>
                            Manage Users
                        </Link>
                    </li>
                    <li>
                        <Link>
                            <SettingsIcon/>
                            Settings
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
        <div class="navbar-center">
            <a class="btn btn-ghost normal-case text-xl"><AppLogo class="w-6 fill-cyan-400"/></a>
        </div>
        <div class="navbar-end">
            <ThemeToggle/>
            <NotificationDropdown/>
        </div>
    </div>
</template>