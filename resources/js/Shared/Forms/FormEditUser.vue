<script setup>
import InputForm from "@/Components/InputForm.vue";
import SelectForm from "@/Components/SelectForm.vue";
import { ref } from 'vue';
import appconfig from '@/appconfig';

const props = defineProps({
    user: Object,
    timetable: Object
})
console.table(props.timetable);

const storage = ref(appconfig.STORAGE_URL)

const weekend = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
const shift = ['Morning', 'Afternoon'];

</script>


<template>
    <div class="px-10">
        <form>
            <div class="grid grid-cols-3">
                <div class="w-full py-10 px-10 ">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="grid row-span-3 justify-center items-center">
                            <div class="avatar">
                                <div class="mask mask-squircle w-60 h-60">
                                    <img :src="storage + user.profile_pic" alt="Profile pic" />
                                </div>
                            </div>
                        </div>
                        
                        <InputForm title="Email" typ="email" :value='user.email' />
                        <InputForm title="DNI" typ="text" :value='user.dni' />
                        <SelectForm title="Role" :data='3' :rol="user.role_id" />
                        <InputForm class="grid col-span-2" title="NAME" typ="text" :value='user.name' />
                    </div>
                    <div class="flex justify-end mt-8">
                        <button class="btn btn-outline btn-error mr-4">Cancel</button>
                        <button class="btn btn-outline btn-success">Save</button>
                    </div>
                
                    <div class="w-full mx-10 py-10 px-10">
                        <div class="grid grid-cols-2 gap-6">
                            <InputForm title="START" typ="date" :value='timetable[0].start_date' />
                            <InputForm title="END" typ="date" :value='timetable[0].end_date'/>
                            <SelectForm title="Weekday" :data="7" :day="timetable"/>
                            <SelectForm title="Shift" :data="2" :shift="timetable"/>
                            <InputForm title="IN" typ="time" :value='timetable[0].starts_at' />
                            <InputForm title="OUT" typ="time" :value='timetable[0].ends_at' />
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</template>