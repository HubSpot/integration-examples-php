function copyFrom(id) {
    let range = document.createRange(), selection = window.getSelection()

    range.selectNode(document.getElementById(id))
    selection.removeAllRanges()
    selection.addRange(range)

    document.execCommand("copy")
    selection.empty()

    document.getElementById('success').classList.remove('hidden')
    setInterval(() => {
        document.getElementById('success').classList.add('hidden')
    }, 3000)
}
