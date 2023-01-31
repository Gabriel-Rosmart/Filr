<script setup>

    import { ref } from "vue"
    import InputForm from "@/Components/InputForm.vue";
    import SelectForm from "@/Components/SelectForm.vue";
    import { Link } from "@inertiajs/inertia-vue3";
    const imgURL = ref('https://imgv3.fotor.com/images/blog-cover-image/10-profile-picture-ideas-to-make-you-stand-out.jpg');

    const weekend = [ 'Monday','Tuesday' ,'Wednesday', 'Thursday', 'Friday'];
    const role = [ 'Admin' ,'User'];
    const shift =['Morning' , 'Afternoon'];
    
</script>

<template>
    <div class="px-10">
        
        <div class="tabs pb-3">
            <a class="tab tab-bordered tab-active">Profile</a>
            <a class="tab tab-bordered">Schedule</a>
        </div>
        <div class="grid grid-cols-2">
            <div class="w-full py-10 border-2 border-solid px-10 rounded-2xl">
                <form>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="grid row-span-2 justify-center">
                            <label>Photo</label>
                            <div class="avatar">
                                <div class="mask mask-squircle w-24 h-24">
                                    <img :src="imgURL" alt="Avatar Tailwind CSS Component" />
                                </div>
                            </div>
                            <button class="btn btn-outline">Change</button>
                        </div>
                        <InputForm tittle="ID"/>
                        <InputForm tittle="NAME" typ="text"/>
                        <SelectForm tittle="Role" :data='role'/>
                        <InputForm tittle="DNI" typ="text"/>
                        <InputForm tittle="Email" typ="text"/>
                        <div/>
                        <div>
                            <button class="btn btn-outline btn-success px-10">Save</button>
                        </div>
                        <div class="grid place-items-end">
                            <button class="btn btn-outline btn-error px-10">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="w-full mx-20 py-10 border-2 border-solid px-10 rounded-2xl">
                <form>
                    <div class="grid grid-cols-2 gap-6">
                        <InputForm tittle="START" typ="date"/>
                        <InputForm tittle="END" typ="date"/>
                        <SelectForm tittle="Weekday" :data="weekend"/>
                        <SelectForm tittle="Shift" :data="shift"/>
                        <InputForm tittle="IN" typ="time"/>
                        <InputForm tittle="OUT" typ="time"/>
                        <div>
                            <button class="btn btn-outline btn-success px-10">Save</button>
                        </div>
                        <div class="grid place-items-end">
                            <button class="btn btn-outline btn-error px-10">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>