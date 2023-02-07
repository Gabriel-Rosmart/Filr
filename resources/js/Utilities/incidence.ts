import trans from './trans'

export default function getIncidenceMessage(subject: string, minutes: number):string {
    if(subject === 'absent') return `<span style="color: red">${trans(subject, 'es')}</span>`
    let highlight = `<span style="color: red">${minutes}</span>`
    if(subject === 'early') return `Sale ${highlight} minutos ${trans(subject, 'es')}`
    if(subject === 'late') return `Llega ${highlight} minutos ${trans(subject, 'es')}`
}