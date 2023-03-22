function generatePost(post) {
	let result = ""
	for (const element of post) {
		let content = `
        <div class="post card mb-3">
            <div class="row g-0">
                <div class="left-col p-2">
                    <a class="username-post-owner fw-bold" href="user.php?username=${element["Username"]}">@${element["Username"]}</a>
                    <div class="post-settings-${element["PostID"]} modal fade" role="dialog" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1">
                        <div id="post-settings" class="modal-dialog modal-dialog-scrollable pb-5">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="action-post" action="#" method="post">
                                        <input type="hidden" name="post-id" value="${element["PostID"]}">`
		if (element["Username"] == element["session-username"]) {
			content += `
                                        <button class="edit-post btn btn-primary mb-2 collapsed" type="button" id="edit-button"
                                                data-bs-toggle="collapse" data-bs-target="#edit-post"
                                                aria-expanded="false" aria-controls="edit-post">
                                            Modifica
                                        </button>
                                        <button class="delete-post btn btn-danger mb-2 collapsed" type="button" id="delete-button"
                                                data-bs-toggle="collapse" data-bs-target="#delete-post"
                                                aria-expanded="false" aria-controls="delete-post">
                                            Elimina
                                        </button>
                                    </form>
                                    <div class="collapse" id="edit-post">
                                        <div class="card card-body">
                                            <form action="#" method="post" enctype="multipart/form-data" class="edit-form">
                                                <label for="edit-post-text">Descrizione:</label>
                                                <textarea id="edit-post-text" class="mb-3" name="description" rows="5">${element["TextContent"]}</textarea>
                                                <input type="hidden" name="post-id" value="${element["PostID"]}">
                                                <button type="submit" name="edit-post" class="btn btn-primary float-end">Salva</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="collapse" id="delete-post">
                                        <div class="card card-body">
                                            <form action="#" method="post" enctype="multipart/form-data">
                                                <p>Sei sicuro di voler eliminare questo post?</p>
                                                <input type="hidden" name="post-id" value="${element["PostID"]}">
                                                <button type="submit" name="delete-post" class="btn btn-danger">Elimina</button>
                                            </form>
                                        </div>
                                    </div>
            `
		} else {
			if (!element["checkSavedPost"]) {
				content += `
                                        <button class="save-post btn btn-primary" type="submit" name="save-post">Salva</button>
                `
			} else {
				content += `
                                        <button class="unsave-post btn btn-primary" type="submit" name="unsave-post">Rimuovi dai salvati</button>
                `
			}
			content += `
                                        <button class="report-post btn btn-warning" type="submt" name="report-post">Segnala</button>
                                    </form>
            `
		}
		content += `
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="reaction-post" action="#" method="post">
                        <input type="hidden" id="post-id" name="post-id" value="${element["PostID"]}">
                        <input type="hidden" id="username" name="username" value="${element["session-username"]}">
                        <div class="reactions">
                            <div class="reaction-5">
                                <img src="../public/assets/img/reazione-5.png" alt="reazione-5" id="reaction-5-${element["PostID"]}" class="reaction-image">
                                <span id="reazione5" class="reaction-count fw-bold">${element["reazione5"]}</span>
                            </div>
                            <div class="reaction-4">
                                <img src="../public/assets/img/reazione-4.png" alt="reazione-4" id="reaction-4-${element["PostID"]}" class="reaction-image">
                                <span id="reazione4" class="reaction-count fw-bold">${element["reazione4"]}</span>
                            </div>
                            <div class="reaction-3">
                                <img src="../public/assets/img/reazione-3.png" alt="reazione-3" id="reaction-3-${element["PostID"]}" class="reaction-image">
                                <span id="reazione3" class="reaction-count fw-bold">${element["reazione3"]}</span>
                            </div>
                            <div class="reaction-2">
                                <img src="../public/assets/img/reazione-2.png" alt="reazione-2" id="reaction-2-${element["PostID"]}" class="reaction-image">
                                <span id="reazione2" class="reaction-count fw-bold">${element["reazione2"]}</span>
                            </div>
                            <div class="reaction-1">
                                <img src="../public/assets/img/reazione-1.png" alt="reazione-1" id="reaction-1-${element["PostID"]}" class="reaction-image">
                                <span id="reazione1" class="reaction-count fw-bold">${element["reazione1"]}</span>
                            </div>
                        </div>
                    </form>
                    <img src="../public/assets/img/user-settings.png" alt="post-settings" data-bs-toggle="modal"
                        data-bs-target=".post-settings-${element["PostID"]}" class="post-settings-icon float-end">
                </div>
                <div class="post-content mid-col p-2">
        `
		if (element["FileName"] != "./upload/") {
			content += `
                    <img class="post-image" src="${element["FileName"]}" alt="">
            `
		}
		if (element["TextContent"] != "") {
			content += `
                    <p class="post-text">${element["TextContent"]}</p>
            `
		}
		content += `
                </div >
                <div class="right-col p-2">
                    <div class="comments-section">
        `
		if (element["commenti"]) {
			element["commenti"].forEach(commento => {
				content += `
                        <div class="comment">
                            <p class="comment-text"><a class="username-comment-owner fw-bold" href="user.php?username=${commento["Username"]}">@${commento["Username"]}</a>: ${commento["TextContent"]}</p>
                        </div>
            `
			})
		}
		content += `
                    </div>
                    <button class="btn btn-primary comment-button" type="button" data-bs-toggle="modal"
                            data-bs-target=".post-comment-${element["PostID"]}">Commenta</button>
                    <div class="post-comment-${element["PostID"]} modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel"
                        aria-hidden="true" role="dialog" data-bs-keyboard="false" data-bs-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="add-comment" method="post" action="#">
                            <textarea class="comment-input mb-3" type="text" name="comment-text" placeholder="Commenta..." rows="3"></textarea>
                            <input type="hidden" name="post-id" value="${element["PostID"]}">
                            <button class="submit-comment btn btn-primary float-end" type="submit" name="submit-comment">Pubblica</button>
                        </form>
                    </div>
                </div>
            </div>
                    </div >
                </div >
            </div >
        </div >
            `
		result += content
	}
	return result
}

function checkPage() {
	const windowPath = window.location.pathname
	let url = ""
	if (windowPath.includes("index.php")) {
		url = "index.php"
	} else if (windowPath.includes("explore.php")) {
		url = "explore.php"
	} else if (windowPath.includes("user.php")) {
		url = "user.php"
	} else if (windowPath.includes("saved.php")) {
		url = "saved.php"
	}
	return url
}

axios.get("postSection.php", { params: { url: checkPage() } }).then(Response => {
	const post = generatePost(Response.data)
	const main = document.getElementById("post-section")
	main.innerHTML = post
	checkReaction(Response.data)
	handlePost()
	handleReactions()
})

function checkReaction(data) {
	for (const element of data) {
		const postId = element["PostID"]
		let reaction
		switch (element["reazione-attiva"][0]) {
			case 1:
				reaction = document.getElementById("reaction-1-" + postId)
				break
			case 2:
				reaction = document.getElementById("reaction-2-" + postId)
				break
			case 3:
				reaction = document.getElementById("reaction-3-" + postId)
				break
			case 4:
				reaction = document.getElementById("reaction-4-" + postId)
				break
			case 5:
				reaction = document.getElementById("reaction-5-" + postId)
				break
			default:
				break
		}
		if (reaction) switchActive(reaction)
	}
}

function switchActive(reaction) {
	const closest = reaction.closest(".active")
	if (closest) closest.classList.remove("active")
	reaction.classList.add("active")
}

function handlePost() {
	const editButton = document.getElementById("edit-button")
	const deleteButton = document.getElementById("delete-button")
	if (editButton && deleteButton) {
		const editDiv = document.getElementById("edit-post")
		const deleteDiv = document.getElementById("delete-post")
		editButton.addEventListener("click", () => checkCollapsibles(editButton, deleteButton, deleteDiv))
		deleteButton.addEventListener("click", () => checkCollapsibles(deleteButton, editButton, editDiv))
	}
}

function checkCollapsibles(buttonClicked, buttonChecked, divChecked) {
	divChecked.classList.remove("show")
	buttonChecked.classList.add("collapsed")
	buttonChecked.setAttribute("aria-expanded", "false")
	buttonClicked.classList.remove("collapsed")
	buttonClicked.setAttribute("aria-expanded", "true")
}

function handleReactions() {
	const reactions = document.querySelectorAll(".reaction-image")
	reactions.forEach(reaction => {
		reaction.addEventListener("click", () => {
			if (reaction.classList.contains("active")) {
				reaction.classList.remove("active")
			} else {
				const oldReaction = reaction.parentElement.parentElement.querySelector(".active")
				if (oldReaction) oldReaction.classList.remove("active")
				reaction.classList.add("active")
			}
			if (reaction.parentElement.classList.contains("reaction-1")) addReaction(reaction, 1)
			else if (reaction.parentElement.classList.contains("reaction-2")) addReaction(reaction, 2)
			else if (reaction.parentElement.classList.contains("reaction-3")) addReaction(reaction, 3)
			else if (reaction.parentElement.classList.contains("reaction-4")) addReaction(reaction, 4)
			else if (reaction.parentElement.classList.contains("reaction-5")) addReaction(reaction, 5)
		})
	})
}

function addReaction(reaction, reactionId) {
	const postId = reaction.parentElement.parentElement.parentElement.querySelector("#post-id").value
	const username = reaction.parentElement.parentElement.parentElement.querySelector("#username").value
	axios.post("reactionSection.php", { ReactionID: reactionId, PostID: postId, Username: username })
	axios.get("reactionSection.php", { params: { PostID: postId } }).then(Response => {
		const count = Response.data
		reaction.parentElement.parentElement.querySelector("#reazione1").innerHTML = count[1]
		reaction.parentElement.parentElement.querySelector("#reazione2").innerHTML = count[2]
		reaction.parentElement.parentElement.querySelector("#reazione3").innerHTML = count[3]
		reaction.parentElement.parentElement.querySelector("#reazione4").innerHTML = count[4]
		reaction.parentElement.parentElement.querySelector("#reazione5").innerHTML = count[5]
	})
}
