//import { createI18n } from 'vue-i18n'
import { createI18n } from "vue-i18n/dist/vue-i18n.esm-bundler.js"
import dateFormats from '@/Locales/Dates/dates'
import en from "./Locales/en.json"
import es from "./Locales/es.json"
import gl from './Locales/gl.json'

const i18n = createI18n({
    legacy: false,
    messages : {
        en: en,
        es: es,
        gl: gl,
    },
    datetimeFormats: dateFormats,
    fallbackLocale : 'en',
    locale: localStorage.getItem("locale") ?? 'en',
})

export default i18n