function toSeconds(h, m, s) {
    return h * 3600 + m * 60 + s
}

function parseTimeToSeconds(time){
    const proccessed = time.split(':')
    return toSeconds(proccessed[0], proccessed[1], proccessed[2])
}

function getTimeDiffInSeconds(time_1, time_2) {
    return parseTimeToSeconds(time_1) - parseTimeToSeconds(time_2)
}

function now(){
    const today = new Date()
    return today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds()
}

export default function getErrors(files, schedule) {
    let errorBag = []
    if(files.length === 0 && getTimeDiffInSeconds(now(), schedule.ends_at) > 0) return ['No ha venido']
    if(files.length >= 1 && getTimeDiffInSeconds(files[0].timestamp, schedule.starts_at) > 0)  errorBag.push('Llega tarde')
    if(files.length >= 2 && getTimeDiffInSeconds(files[1].timestamp, schedule.ends_at) < 0) errorBag.push('Sale antes')

    return errorBag
}