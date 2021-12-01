const addImage = document.querySelector("#add-image")

addImage.addEventListener('click', () => {
    const widgetCounter = document.querySelector("#widgets-counter")
    const index = +widgetCounter.value
    const addCarImages = document.querySelector('#add_car_images')

    const prototype = addCarImages.dataset.prototype.replace(/__name__/g, index)

    addCarImages.insertAdjacentHTML('beforeend', prototype)
    widgetCounter.value = index + 1
zzd
    handleDeleteButtons()
})

const updateCounter = () => {
    const count = document.querySelectorAll('#add_car_images div.form-group').length
    document.querySelector('#widgets-counter').value = count
}

const handleDeleteButtons = () => {
    var deletes = document.querySelectorAll("button[data-action='delete']")

    deletes.forEach(button => {
        button.addEventListener('click', () => {
            const target = button.dataset.target
            const elementTarget = document.querySelector(target)
            if (elementTarget) {
                elementTarget.remove()
            }
        })

    })
}

updateCounter()
handleDeleteButtons()