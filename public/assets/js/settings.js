const cropperSettings = {
	aspectRatio: 1,
	viewMode: 2,
	dragMode: "move",
	center: true,
	guides: true,
	toggleDragModeOnDblclick: false,
	cropBoxMovable: true,
	cropBoxResizable: true,
	movable: false,
	resizable: false,
	rotatable: false,
	zoomable: false,
	responsive: false,
	background: true,
	minContainerHeight: 200,
	minCanvasHeight: 200,
	minCropBoxHeight: 50
}
let cropper

window.addEventListener("load", () => {
	const profilePicInput = document.getElementById("profile-pic-input")
	profilePicInput.addEventListener("change", () => previewProfilePic(profilePicInput.files[0]))

	const submitButton = document.getElementById("submit-button")
	submitButton.addEventListener("click", () => handleSubmit())
})

function previewProfilePic(file) {
	const validImageTypes = ["image/jpg", "image/jpeg", "image/png"]
	if (file && validImageTypes.includes(file.type)) {
		const oFReader = new FileReader()
		oFReader.readAsDataURL(file)
		oFReader.onload = oFREvent => {
			const cropperContainer = document.getElementById("cropper-container")

			if (cropperContainer.hasChildNodes()) {
				for (const child of cropperContainer.childNodes) {
					cropperContainer.removeChild(child)
				}
				if (cropper != undefined) cropper.destroy()
			}

			const cropperImage = document.createElement("img")
			cropperImage.setAttribute("id", "cropper-image")
			cropperImage.setAttribute("src", oFREvent.target.result)
			cropperImage.setAttribute("alt", "cropper image")
			cropperContainer.appendChild(cropperImage)

			cropper = new Cropper(cropperImage, cropperSettings)

			const cropButton = document.createElement("button")
			cropButton.setAttribute("type", "button")
			cropButton.setAttribute("class", "btn btn-primary")
			cropButton.innerText = "Taglia"
			cropButton.addEventListener("click", () => handleCut(cropper))
			cropperContainer.appendChild(cropButton)
		}
	}
}

function handleCut(cropper) {
	const croppedImage = cropper.getCroppedCanvas().toDataURL()
	const profilePicPreview = document.getElementById("profile-pic-preview")
	profilePicPreview.setAttribute("src", croppedImage)
}

function handleSubmit() {
	const bio = document.getElementById("bio").value
	const picInputFile = document.getElementById("profile-pic-input").files[0]
	const closeButton = document.getElementById("close-button")
	closeButton.click()
	if (picInputFile === undefined) {
		const profilePic = document.getElementById("profile-pic-preview").getAttribute("src")
		axios
			.post("profileSettingsApi.php", { bio: bio, profilePic: profilePic })
			.then(() => (window.location.href = getUserProfilePage()))
	} else {
		const profilePic = picInputFile.name
		const encodedImage = document.getElementById("profile-pic-preview").getAttribute("src")
		axios
			.put("profileSettingsApi.php", { encodedImage: encodedImage, profilePic: profilePic })
			.then(() =>
				axios
					.post("profileSettingsApi.php", { bio: bio, profilePic: profilePic })
					.then(() => (window.location.href = getUserProfilePage()))
			)
	}
}

function getUserProfilePage() {
	const navBarElements = document.querySelectorAll("div.nav-col")
	const userElement = navBarElements[navBarElements.length - 1].querySelector("a")
	const userLink = userElement.getAttribute("href")
	return userLink
}
