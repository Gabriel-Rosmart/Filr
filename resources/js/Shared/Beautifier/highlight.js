export default function highlight (text, reg) {
    if(reg == null) return text
    return text.replace(new RegExp(reg, "gi"), match => {
        return '<span class="text-red-600">' + match + '</span>'
    })
}