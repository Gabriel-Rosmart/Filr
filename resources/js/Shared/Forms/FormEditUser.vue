<script setup>

    import { ref } from "vue"
    import InputForm from "@/Components/InputForm.vue";
    import SelectForm from "@/Components/SelectForm.vue";
    import { Link } from "@inertiajs/inertia-vue3";
    const imgURL = ref('https://imgv3.fotor.com/images/blog-cover-image/10-profile-picture-ideas-to-make-you-stand-out.jpg');

    const weekend = [ 'Monday','Tuesday' ,'Wednesday', 'Thursday', 'Friday'];
    const role = [ 'Admin' ,'User'];
    const shift =['Morning' , 'Afternoon'];
    
    const users = ref([
    {
        "id": 1,
        "dni": "456454654R",
        "name": "Pepe Pepez Pepez",
        "email": "pepe@pepez.ez",
        "start": "2023-05-12",
        "end": "2024-12-20",
        "startm": "08:10",
        "endm": "14:30",
    }
])

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
                        <InputForm tittle="ID" :value='users[0].id'/>
                        <InputForm tittle="Email" typ="email" :value='users[0].email'/>
                        <SelectForm tittle="Role" :data='role' />
                        <InputForm tittle="DNI" typ="text" :value='users[0].dni'/>
                        <InputForm class="grid col-span-2" tittle="NAME" typ="text" :value='users[0].name'/>
                    </div>
                    <div class=" h-40 py-10 justify-start">
                    <div>
                        <button class="btn btn-outline btn-success ">Save</button>
                        <button class="mx-10 btn btn-outline btn-error ">Cancel</button>
                    </div>
                </div>
                </div>
                <!--
                <div class="w-full mx-10 py-10 px-10">
                    <div class="grid grid-cols-2 gap-6">
                        <InputForm tittle="START" typ="date" :value='users[0].start' />
                        <InputForm tittle="END" typ="date" :value='users[0].end'/>
                        <SelectForm tittle="Weekday" :data="weekend" />
                        <SelectForm tittle="Shift" :data="shift" />
                        <InputForm tittle="IN" typ="time" :value='users[0].startm' />
                        <InputForm tittle="OUT" typ="time" :value='users[0].endm' />
                    </div>
                </div>
                -->
               
            </div>
        </form>
    </div>
</template>