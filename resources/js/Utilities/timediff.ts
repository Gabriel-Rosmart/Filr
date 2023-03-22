type Schedule = {
    id: number,
    date_range_id: number,
    day: string,
    starts_at: string,
    ends_at: string,
    created_at: any,
    updated_at: any
}

type File = {
    id: number,
    user_id: number,
    timestamp: string
}

/**
 * 
 * Transforma a given hour:minutes:seconds
 * to seconds only
 * @param h number
 * @param m number
 * @param s number
 * @returns number
 */
function toSeconds(h: number, m: number, s: number): number {
    return h * 3600 + m * 60 + s
}

/**
 * Transforma time string in h:m:s format to seconds
 * @param time string
 * @returns number
 */
function parseTimeToSeconds(time: String): number{
    const proccessed = time.split(':')
    return toSeconds(parseInt(proccessed[0]), parseInt(proccessed[1]), parseInt(proccessed[2]))
}

/**
 * Provide two time string in h:m:s format
 * and get the difference in seconds
 * @param time_1 string
 * @param time_2 string
 * @returns number
 */
function getTimeDiffInSeconds(time_1: string, time_2: string): number {
    return parseTimeToSeconds(time_1) - parseTimeToSeconds(time_2)
}

/**
 * Get current time
 * @returns string
 */
function now(): string {
    const today = new Date()
    return today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds()
}

/**
 * Determine the correct message based on provided times
 * @param files Array<File>
 * @param schedule Schedule
 * @returns Array<string>
 */
export default function getUserTimeShiftMessages(files: Array<File>, schedule: Schedule): Array<string> {
    let errorBag = []
    if(files.length === 0 && getTimeDiffInSeconds(now(), schedule.ends_at) > 0) return ['No ha venido']
    if(files.length >= 1 && getTimeDiffInSeconds(files[0].timestamp, schedule.starts_at) > 0)  errorBag.push('Llega tarde')
    if(files.length >= 2 && getTimeDiffInSeconds(files[1].timestamp, schedule.ends_at) < 0) errorBag.push('Sale antes')

    return errorBag
}