<script setup>
import InputForm from "@/Components/InputForm.vue";
import SelectForm from "@/Components/SelectForm.vue";
const props = defineProps({
    user: Object,
    form: Object
})

console.table(props.user);

</script>

<template>
    <div class=" grid justify-items-center py-10 pl-10 ">
        <div class="grid grid-cols-2 w-max gap-6">
            <div class="grid row-span-3 justify-center items-center">
                <div class="avatar">
                    <div class="mask mask-squircle w-60 h-60">
                        <img :src="storage + user.profile_pic" alt="Profile pic" />
                    </div>
                </div>
            </div>
            <InputForm title="Email" type="email" v-model="form.email" :value='user.email' />
            <InputForm title="DNI" type="text" v-model="form.dni" :value='user.dni' />
            <InputForm title="Phone" type="telephone" v-model="form.telephone" :value='user.phone' />
            <SelectForm title="Role" :data='3' :rol="user.role_id" />
            <InputForm title="Name" type="text" v-model="form.name" :value='user.name' />
        </div>
    </div>
</template>