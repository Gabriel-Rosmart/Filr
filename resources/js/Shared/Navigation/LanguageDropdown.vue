<script setup>
    import LanguageIcon from '../Icons/LanguageIcon.vue'
    import appconfig from '@/appconfig'
    import { useI18n } from 'vue-i18n'

    let { locale } = useI18n()

    const changeLocale = (newLocale) => {
        locale.value = newLocale
        localStorage.setItem('locale', newLocale)

        axios.post('/locale', { 'locale': newLocale })
        .then(function (response) { console.log(response.data); })
        .catch(function (error) { console.log(error); });
    }
</script>

<template>
    <div class="dropdown dropdown-end mr-6">
        <button tabindex="0" class="btn btn-ghost btn-circle m-1">
            <LanguageIcon/>
        </button>
        <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
            <li 
                v-for="language in appconfig.locales" 
                class="cursor-pointer dark:hover:text-cyan-500 hover:font-bold"
                @click="changeLocale(language.code)">
                <a @click.prevent="">{{ language.lang }}</a>
            </li>
        </ul>
    </div>
</template>