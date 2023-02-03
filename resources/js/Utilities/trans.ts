
// TODO: get this data from external json data

const availableLocales = {
    'es': {
        'monday': 'lunes',
        'tuesday': 'martes'
    },
    'ga' : {
        'monday': 'luns',
        'tuesday': 'xoves'
    }
}

export default function trans(text: string, locale: string): string {
    const localesObject = availableLocales[locale]
    if(localesObject == undefined) return ''
    const message = localesObject[text]
    return message ?? ''
}