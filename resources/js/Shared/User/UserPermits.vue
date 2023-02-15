<script setup>

import { CheckIcon, XIcon } from "../Icons/Icons";
import infoIcon from "../Icons/infoIcon.vue";

defineProps({
    permits: Array
})

</script>

<template>
    <div v-if="permits.length > 0" class="overflow-x-auto w-full">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>PID</th>
                    <th>Requested At</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="permit of permits" class="hover">
                    <td>{{ permit.uuid }}</td>
                    <td>{{ permit.requested_at }}</td>
                    <td>
                        <div v-if="permit.status === 'accepted'" class="flex">
                            <CheckIcon class="stroke-green-500" />
                            <span class="ml-6">{{ permit.status }}</span>
                        </div>
                        <div v-else-if="permit.status === 'denied'" class="flex">
                            <XIcon class="stroke-red-500" />
                            <span class="ml-6">{{ permit.status }}</span>
                        </div>
                        <div v-else-if="permit.status === 'pending'" class="flex">
                            <infoIcon class="stroke-yellow-500" />
                            <span class="ml-6">{{ permit.status }}</span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
    <div v-else>
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