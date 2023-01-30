function toSeconds(h, m, s) {
    return h * 3600 + m * 60 + s
}

export default function diff(time_in_schedule, time_in_real) {
    const ts = time_in_schedule.split(':')
    const tr = time_in_real.split(':')
    return toSeconds(tr[0], tr[1], tr[2]) - toSeconds(ts[0], ts[1], ts[2]) > 0 ?
        'LLega tarde' : ''
}