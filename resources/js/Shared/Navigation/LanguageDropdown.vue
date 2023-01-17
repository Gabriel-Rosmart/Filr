<script setup>
    import LanguageIcon from '../Icons/LanguageIcon.vue';
    const languages = [
        {
            'lang': 'English',
            'code': 'en'
        },
        {
            'lang': 'Español',
            'code': 'es'
        }
    ]
    const changeLocale = (locale) => {
        console.log(locale)
    }
</script>

<template>
    <div class="dropdown dropdown-end mr-6">
        <button tabindex="0" class="btn btn-ghost btn-circle m-1">
            <LanguageIcon/>
        </button>
        <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
            <li 
                v-for="language in languages" 
                class="cursor-pointer dark:hover:text-cyan-500 hover:font-bold"
                @click="changeLocale(language.code)">
                {{ language.lang }}
            </li>
        </ul>
    </div>
</template>