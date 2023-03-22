window.onload = () => {
	console.log("loaded")
	const followButtons = document.querySelectorAll(".followBtn")
	followButtons.forEach(button => {
		button.addEventListener("click", () => {
			const username = button.id
			axios.post("updateFollow.php", { Username: username }).then(Response => {
				if (Response.data == "follow") button.innerHTML = "Smetti di seguire"
				else if (Response.data == "unfollow") button.innerHTML = "Segui"
			})
		})
	})

	document.querySelector("#search-form").addEventListener("submit", e => {
		if (document.querySelector("#search").value === "") e.preventDefault()
	})
}
