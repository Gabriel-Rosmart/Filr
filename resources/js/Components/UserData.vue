<script setup>
import appconfig from "@/appconfig";
import InputForm from "@/Components/InputForm.vue";
import SelectForm from "@/Components/SelectForm.vue";
import { ref } from "vue";

const props = defineProps({
    user: Object,
    form: Object
})

console.table(props.user);

const storage = ref(appconfig.STORAGE_URL);

</script>

<template>
    <div class=" grid justify-items-center py-10 pl-10 ">
        <div class="grid grid-cols-2 w-max gap-6">
            <div class="grid row-span-3 justify-center items-center">
                <div class="avatar">
                    <div class="mask mask-squircle w-80 h-80">
                        <img class="hover:opacity-70" :src="storage + user.profile_pic" alt="Profile pic" />
                    </div>
                </div>
            </div>
            <InputForm title="Name" type="text" v-model="form.name" :value='user.name' />
            <InputForm title="DNI" type="text" v-model="form.dni" :value='user.dni' />
            <InputForm title="Email" type="email" v-model="form.email" :value='user.email' />
            <InputForm title="Profile pic" type="file" v-model="form.pic" />
            <InputForm title="Phone" type="telephone" v-model="form.telephone" :value='user.phone' />
            <SelectForm title="Role" :data='3' :rol="user.role_id" :disabled="user.is_admin" />
            <InputForm v-if="user.is_admin == 0" title="New password" type="password" v-model="form.pass" />
            <div></div>
            <InputForm v-if="user.is_admin == 0" title="Repeat password" type="password" v-model="form.repeatPass" />
        </div>
    </div>
</template>