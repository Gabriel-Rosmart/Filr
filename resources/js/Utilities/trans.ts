import gal from '@/Utilities/Lang/gal'
import es from '@/Utilities/Lang/es'


const availableLocales = {
    'es': es,
    'gal' : gal
}

/**
 * 
 * This script translate a string
 * to the provided locale
 * 
 * 
 * @param text string
 * @param locale string
 * @returns string
 */
export default function trans(text: string, locale: string): string {
    const localesObject = availableLocales[locale]
    if(localesObject == undefined) return ''
    const message = localesObject[text]
    return message ?? ''
}