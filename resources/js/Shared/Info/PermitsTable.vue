<script setup>
    import { ref } from "vue"
    import { CheckIcon, XIcon } from "../Icons/Icons";

    const permits = ref([
        {
            "pid": "456793h",
            "requested_by": "John",
            "requested_at": "2023-1-12",
            "status": "pending"
        },
        {
            "pid": "176595k",
            "requested_by": "Jake",
            "requested_at": "2023-1-20",
            "status": "denied"
        },
        {
            "pid": "778354p",
            "requested_by": "Trudy",
            "requested_at": "2022-12-21",
            "status": "accepted"
        }
    ])

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
                        {{ permit.pid }}
                    </td>
                    <td>
                        {{ permit.requested_by }}
                    </td>
                    <td>
                        {{ permit.requested_at }}
                    </td>
                    <th v-if="permit.status === 'pending'">
                        <div>
                            <button class="btn btn-outline btn-success">Accept</button>
                            <button class="btn btn-outline btn-error ml-8">Deny</button>
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