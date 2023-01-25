<script setup>

const userData = {
    name: "Pepe",
    surname: "Pepez Pepez",
    email: "pepe@pepez.ez",
    image: "https://imgv3.fotor.com/images/blog-cover-image/10-profile-picture-ideas-to-make-you-stand-out.jpg"
}




</script>


<template>
    <div class="flex justify-start">
        <div class="avatar online">
            <div class="w-24 rounded-full">
                <img :src="userData.image" />
            </div>
        </div>
        <div>
            <div class="flex gap-4 items-end">
                <span class="text-5xl">{{ userData.name }}</span>
                <span class="text-2xl">{{ userData.surname }}</span>
            </div>
            <div>
                <span>
                    &lt {{ userData.email }} &gt
                </span>
            </div>

        </div>
    </div>


</template>