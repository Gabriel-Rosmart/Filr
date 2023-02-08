<script setup>
    import format from '@/Utilities/datefm'
    const props = defineProps({
        permits: Array
    })
</script>
<template>
    <div class="overflow-x-autp">
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
                    <td>
                        {{ permit.uuid }}
                    </td>
                    <td>
                        {{ format(permit.requested_at) }}
                    </td>
                    <td>
                        {{ permit.status }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>