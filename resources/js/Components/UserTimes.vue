<script setup>
import InputForm from "@/Components/InputForm.vue";
const props = defineProps({
    weekend: Array,
})
</script>

<template>
    <div class="flex justify-center">
        <table class="table w-max">
            <thead>
                <tr class="">
                    <th></th>
                    <th>In (Morning)</th>
                    <th>Out (Morning)</th>
                    <th>In (Afternoon)</th>
                    <th>Out (Afternoon)</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="day in weekend">
                    <th>{{ day.day }}</th>
                    <td>
                        <InputForm type="time" :value='day.starts_at' />
                    </td>
                    <td>
                        <InputForm type="time" :value='day.ends_at' />
                    </td>
                    <td>
                        <InputForm type="time" :value='day.starts_at' />
                    </td>
                    <td>
                        <InputForm type="time" :value='day.ends_at' />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>