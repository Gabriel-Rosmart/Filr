import trans from './trans'

export default function getIncidenceMessage(subject: string, minutes: number):string {
    return `${trans(subject, 'es')}: ${minutes}`
}