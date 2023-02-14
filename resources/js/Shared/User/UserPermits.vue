<script setup>

import { CheckIcon, XIcon } from "../Icons/Icons";
import infoIcon from "../Icons/infoIcon.vue";

defineProps({
    permits: Array
})

</script>

<template>
    <div class="overflow-x-auto w-full">
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
</template>