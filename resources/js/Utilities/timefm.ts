export default function format(time: string): string {
    const parts = time.split(':')
    if(parts[0].length <= 1) parts[0] = '0' + parts[0]
    return parts.join(':')
}