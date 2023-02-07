import trans from './trans'

export default function getIncidenceMessage(subject: string, minutes: number):string {
    if(subject === 'absent') return trans(subject, 'es')
    if(subject === 'early') return `Sale ${minutes} minutos ${trans(subject, 'es')}`
    if(subject === 'late') return `Llega ${minutes} minutos ${trans(subject, 'es')}`
}