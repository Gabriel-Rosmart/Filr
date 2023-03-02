<script setup>
    import FormInputError from '@/Shared/Forms/FormInputError.vue';
    const props = defineProps({
        form : Object
    })
</script>

<template>
    <div class="flex flex-row gap-5">
        <div class="flex flex-row gap-5">
            <input type="date" class="input input-bordered dark:input-primary w-full max-w-xs focus:border-none focus:ring-0"
            v-model="form.day"/>
            <input type="date" class="input input-bordered dark:input-primary w-full max-w-xs focus:border-none focus:ring-0"
            v-model="form.dayOut"/>
        </div>
        <div class="flex flex-row gap-5">
            <FormInputError class="mt-2" :message="form.errors.day" />
            <FormInputError class="mt-2" :message="form.errors.dayOut" />
        </div>
    </div>
</template>