window.addEventListener("load", () => {
	const profilePicInput = document.getElementById("profile-pic-input")
	profilePicInput.addEventListener("change", () => {
		previewProfilePic(profilePicInput.files[0])
	})

	const submitButton = document.getElementById("submit-button")
	submitButton.addEventListener("click", () => handleSubmit())
})

function previewProfilePic(file) {
	const validImageTypes = ["image/jpg", "image/jpeg", "image/png"]
	if (file && validImageTypes.includes(file.type)) {
		const oFReader = new FileReader()
		oFReader.readAsDataURL(file)
		oFReader.onload = oFREvent => {
			const profilePicPreview = document.getElementById("profile-pic-preview")
			profilePicPreview.setAttribute("src", oFREvent.target.result)
		}
	}
}

function handleSubmit() {
	const bio = document.getElementById("bio").value
	const picInput = document.getElementById("profile-pic-input").files[0]
	const closeButton = document.getElementById("close-button")
	closeButton.click()
	if (picInput === undefined) {
		const profilePic = document.getElementById("profile-pic-preview").getAttribute("src")
		axios.post("profileSettingsApi.php", { bio: bio, profilePic: profilePic }).then(() => {
			window.location.href = getUserProfilePage()
		})
	} else {
		const profilePic = picInput["name"]
		const reader = new FileReader()
		reader.readAsDataURL(picInput)
		reader.onloadend = () => {
			const encodedImage = reader.result
			axios.put("profileSettingsApi.php", { encodedImage: encodedImage, profilePic: profilePic })
		}
		axios.post("profileSettingsApi.php", { bio: bio, profilePic: profilePic }).then(() => {
			window.location.href = getUserProfilePage()
		})
	}
}

function getUserProfilePage() {
	const navBarElements = document.querySelectorAll("div.nav-col")
	const userElement = navBarElements[navBarElements.length - 1].querySelector("a")
	const userLink = userElement.getAttribute("href")
	return userLink
}
