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

const imgURL = ref('https://imgv3.fotor.com/images/blog-cover-image/10-profile-picture-ideas-to-make-you-stand-out.jpg');

const weekend = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
const shift = ['Morning', 'Afternoon'];


</script>
<template>
    <div class="px-10">
        <form>
            <div class="grid grid-cols-3">
                <div class="w-full py-10 px-10 ">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="grid row-span-2 justify-center">
                            <label>Photo</label>
                            <div class="avatar">
                                <div class="mask mask-squircle w-24 h-24">
                                    <img :src="imgURL" alt="Avatar Tailwind CSS Component" />
                                </div>
                            </div>
                        </div>
                        <InputForm tittle="ID" :value='user.id' />
                        <InputForm tittle="Email" typ="email" :value='user.email' />
                        <SelectForm tittle="Role" :data='3' :rol="user.role_id" />
                        <InputForm tittle="DNI" typ="text" :value='user.dni' />
                        <InputForm class="grid col-span-2" tittle="NAME" typ="text" :value='user.name' />
                    </div>
                    <div class="w-90 h-40 mx-20 py-10 px-10">
                        <div>
                            <button class="btn btn-outline btn-success ">Save</button>
                            <button class="mx-10 btn btn-outline btn-error ">Cancel</button>
                        </div>
                    </div>
                </div>
                
                <div class="w-full mx-10 py-10 px-10">
                    <div class="grid grid-cols-2 gap-6">
                        <InputForm tittle="START" typ="date" :value='timetable[0].start_date' />
                        <InputForm tittle="END" typ="date" :value='timetable[0].end_date'/>
                        <SelectForm tittle="Weekday" :data="7" :day="timetable"/>
                        <SelectForm tittle="Shift" :data="2" :shift="timetable"/>
                        <InputForm tittle="IN" typ="time" :value='timetable[0].starts_at' />
                        <InputForm tittle="OUT" typ="time" :value='timetable[0].ends_at' />
                    </div>
                </div>
                

            </div>
        </form>
    </div>
</template>