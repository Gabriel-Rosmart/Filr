<script setup>
    import { Inertia } from "@inertiajs/inertia";
    import { CheckIcon, XIcon } from "../Icons/Icons";

    defineProps({
        permits: Array
    })

    const accept = (pid) => {
        Inertia.post('/permits', {
            id: pid,
            action: 'accept'
        })
    }

    const deny = (pid) => {
        Inertia.post('/permits', {
            id: pid,
            action: 'deny'
        })
    }

</script>

<template>
    <div class="overflow-x-auto w-full">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>PID</th>
                    <th>Requested By</th>
                    <th>Requested At</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="permit of permits" class="hover">
                    <td>
                        {{ permit.uuid }}
                    </td>
                    <td>
                        {{ permit.user.name }}
                    </td>
                    <td>
                        {{ permit.requested_at }}
                    </td>
                    <th v-if="permit.status === 'pending'">
                        <div>
                            <button class="btn btn-outline btn-success" @click="accept(permit.pid)">Accept</button>
                            <button class="btn btn-outline btn-error ml-8" @click="deny(permit.pid)">Deny</button>
                        </div>
                    </th>
                    <th v-else>
                        <div v-if="permit.status === 'accepted'" class="flex">
                            <CheckIcon class="stroke-green-500"/>
                            <span class="ml-6">{{ permit.status }}</span>
                        </div>
                        <div v-else class="flex">
                            <XIcon class="stroke-red-500"/>
                            <span class="ml-6">{{ permit.status }}</span>
                        </div>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</template>