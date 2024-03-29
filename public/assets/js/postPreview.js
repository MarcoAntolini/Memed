window.addEventListener("load", () => {
	const imageInput = document.getElementById("image-input")
	imageInput.addEventListener("change", () => previewImage(imageInput.files[0]))

	const descriptionInput = document.getElementById("description-input")
	descriptionInput.addEventListener("keyup", () => previewDescription(descriptionInput.value))
})

function previewImage(file) {
	const validImageTypes = ["image/gif", "image/jpg", "image/jpeg", "image/png"]
	if (file && validImageTypes.includes(file.type)) {
		const oFReader = new FileReader()
		oFReader.readAsDataURL(file)
		oFReader.onload = oFREvent => {
			const imagePreview = document.getElementById("image-preview")
			const imageContent = `
            <img src="${oFREvent.target.result}" alt="image-preview">
            `
			imagePreview.innerHTML = imageContent
		}
	}
}

function previewDescription(text) {
	const descriptionPreview = document.getElementById("description-preview")
	descriptionPreview.innerText = text
}
