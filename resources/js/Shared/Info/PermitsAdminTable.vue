<script setup>

/** Icon imports */
import { CheckIcon, XIcon } from "../Icons/Icons";

/** Component imports */
import { Link } from "@inertiajs/inertia-vue3";

/** Function imports */
import { Inertia } from "@inertiajs/inertia";
import trans from "@/Utilities/trans";
import format from '@/Utilities/datefm'

import { useI18n } from 'vue-i18n'

const { t, d } = useI18n()

defineProps({
    permits: Array
})

const accept = (pid) => {
    Inertia.post('/permits', {
        uuid: pid,
        status: 'accepted'
    })
}

const deny = (pid) => {
    Inertia.post('/permits', {
        uuid: pid,
        status: 'denied'
    })
}

</script>

<template>
    <div class="overflow-x-auto w-full" v-if="permits.length > 0">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>PID</th>
                    <th>{{ t('table.reqby') }}</th>
                    <th>{{ t('table.reqat') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="permit of permits" class="hover">
                    <td>
                        {{ permit.uuid }}
                    </td>
                    <td>
                        {{ d(permit.requested_at, 'short') }}
                    </td>
                    <th v-if="permit.status === 'pending'">
                        <div>
                            <button class="btn btn-outline btn-success" @click="accept(permit.uuid)">{{
                                t('admin.buttons.accept')
                            }}</button>
                            <button class="btn btn-outline btn-error ml-8" @click="deny(permit.uuid)">{{
                                t('admin.buttons.deny')
                            }}</button>
                        </div>
                    </th>
                    <th v-else>
                        <div v-if="permit.status === 'accepted'" class="flex">
                            <CheckIcon class="stroke-green-500" />
                            <span class="ml-6">{{ t(`admin.permitstate.${permit.status }`) }}</span>
                        </div>
                        <div v-else class="flex">
                            <XIcon class="stroke-red-500" />
                            <span class="ml-6">{{ t(`admin.permitstate.${ permit.status }`) }}</span>
                        </div>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="overflow-x-auto w-full" v-else>
        <div class="alert alert-info shadow-lg">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="stroke-current flex-shrink-0 w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>No permits found</span>
            </div>
        </div>
    </div>
</template>