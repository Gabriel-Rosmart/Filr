<script setup>

    /** Icon imports */
    import { BellIcon } from '../Icons/Icons';

    /** Component imports */
    import { Link } from '@inertiajs/inertia-vue3';

    /** Function imports */
    import { useI18n } from 'vue-i18n'
    import { onMounted, ref } from 'vue'
    import axios from 'axios';

    const { t } = useI18n()

    const pendingPermits = ref(0)

    const getPendingPermitsCount = async () => {
        axios.get('/permits/pending').then(response => pendingPermits.value = response.data)
    }

    onMounted(() => {
        getPendingPermitsCount()
    })
</script>

<template>
    <div class="dropdown dropdown-end">
        <button tabindex="0" class="btn btn-ghost btn-circle m-1">
            <div class="indicator">
                <BellIcon/>
                <span class="badge badge-xs badge-primary indicator-item" v-if="pendingPermits != 0"></span>
            </div>
        </button>
        <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52 whitespace-nowrap" v-if="pendingPermits != 0">
            <li>
                <Link href="/admin/permits">{{ t('admin.navbar.notification') }}</Link>
            </li>
        </ul>
    </div>
</template>