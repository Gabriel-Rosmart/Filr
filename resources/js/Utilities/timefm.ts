/**
 * Append a 0 to the bigining a time string
 * if it does not exists
 * 
 * @param time string
 * @returns string
 */

export default function format(time: string): string {
    const parts = time.split(':')
    if(parts[0].length <= 1) parts[0] = '0' + parts[0]
    return parts.join(':')
}