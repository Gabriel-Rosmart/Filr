<script setup>

    /** component imports */
    import { Link } from '@inertiajs/inertia-vue3'

    /** Function imports */
    import { ref } from 'vue'

    /** Config imports */
    import appconfig  from '@/appconfig'

    import { useI18n } from 'vue-i18n'

    const { t } = useI18n()

    const props = defineProps({
        users: Array,
        filters: Object
    })

    const storage = ref(appconfig.STORAGE_URL)

    const getUserStatus = (status) => {
        return status ? 'active' : 'inactive'
    }

</script>

<template>
    <div class="overflow-x-auto w-full">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>{{ t('table.name') }}</th>
                    <th>{{ t('table.job') }}</th>
                    <th>{{ t('table.status') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user of users" class="hover">
                    <td>
                        <div class="flex items-center space-x-3">
                            <div class="avatar">
                                <div class="mask mask-squircle w-12 h-12">
                                    <img :src="storage + user.profile_pic"
                                        alt="Avatar" />
                                </div>
                            </div>
                            <div>
                                <div class="font-bold">
                                    <Link class="dark:hover:text-cyan-400 hover:underline" :href="'/admin/details?id=' + user.id">{{ user.name }}</Link>
                                </div>
                                <div class="text-sm opacity-50">{{ user.email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ user.role.role_name }}
                    </td>
                    <td>
                        <div class="indicator ">
                        <span class="indicator-item indicator-middle indicator-start badge h-2" :class="{'badge-info': user.active, 'badge-error': !user.active}"></span>
                        <div class="ml-6">{{ t(`admin.query.userstate.${getUserStatus(user.active)}`) }}</div>
                        </div>
                    </td>
                    <th>
                        <Link :href="'/admin/details?id=' + user.id" as="button" class="btn btn-ghost btn-xs">detalles</Link>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</template>