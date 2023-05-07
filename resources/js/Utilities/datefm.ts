/**
 * Format any given date in m-d-Y to d-m-Y
 * @param date string
 * @returns string
 */
export default function format(date: string) {
    const splitted = date.split('-')
    return splitted[2] + '-' + splitted[1] + '-' + splitted[0]
}