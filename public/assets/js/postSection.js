window.addEventListener("load", () => {
	axios.get("postApi.php", { params: { url: checkPage() } }).then(Response => {
		const post = generatePost(Response.data)
		const main = document.getElementById("post-section")
		main.innerHTML = post
		Response.data.forEach(element => checkReaction(element))
		handlePost()
		handleReactions()
	})
})

function generatePost(post) {
	let content = ""
	for (const element of post) {
		content += `
        <div class="post card mb-3" id="post-${element["PostID"]}">
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
		if (element["Username"] == element["loggedUser"]) {
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
                        <input type="hidden" id="username" name="username" value="${element["loggedUser"]}">
                        <div class="reactions">
                            <div class="reaction-5">
                                <img src="../public/assets/img/reaction-5.png" alt="reaction-5" id="reaction-5-${element["PostID"]}" class="reaction-image">
                                <span id="reaction5" class="reaction-count fw-bold">${element["reaction5"]}</span>
                            </div>
                            <div class="reaction-4">
                                <img src="../public/assets/img/reaction-4.png" alt="reaction-4" id="reaction-4-${element["PostID"]}" class="reaction-image">
                                <span id="reaction4" class="reaction-count fw-bold">${element["reaction4"]}</span>
                            </div>
                            <div class="reaction-3">
                                <img src="../public/assets/img/reaction-3.png" alt="reaction-3" id="reaction-3-${element["PostID"]}" class="reaction-image">
                                <span id="reaction3" class="reaction-count fw-bold">${element["reaction3"]}</span>
                            </div>
                            <div class="reaction-2">
                                <img src="../public/assets/img/reaction-2.png" alt="reaction-2" id="reaction-2-${element["PostID"]}" class="reaction-image">
                                <span id="reaction2" class="reaction-count fw-bold">${element["reaction2"]}</span>
                            </div>
                            <div class="reaction-1">
                                <img src="../public/assets/img/reaction-1.png" alt="reaction-1" id="reaction-1-${element["PostID"]}" class="reaction-image">
                                <span id="reaction1" class="reaction-count fw-bold">${element["reaction1"]}</span>
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
                </div>
                <div class="right-col p-2">
                    <div class="comments-section">
        `
		if (element["comments"]) {
			element["comments"].forEach(comment => {
				content += `
                        <div class="comment" id="comment-${comment["CommentID"]}">
                            <p class="comment-text">
                                <a class="username-comment-owner fw-bold" href="user.php?username=${comment["Username"]}">
                                    @${comment["Username"]}
                                </a>: ${comment["TextContent"]}
                            </p>
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
                    </div>
                </div>
            </div>
        </div>
        `
	}
	return content
}

function checkPage() {
	const windowPath = window.location.pathname
	if (windowPath.includes("index.php")) return "index.php"
	else if (windowPath.includes("explore.php")) return "explore.php"
	else if (windowPath.includes("user.php")) return "user.php"
	else if (windowPath.includes("savedPosts.php")) return "savedPosts.php"
}

function checkReaction(element) {
	const postId = element["PostID"]
	let reaction
	switch (element["activeReaction"]) {
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
			document.querySelector("post-" + postId + " .active")?.classList.remove("active")
			break
	}
	if (reaction) switchActive(reaction)
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
	axios.post("reactionApi.php", { ReactionID: reactionId, PostID: postId }).then(() => {
		axios.get("reactionApi.php", { params: { PostID: postId } }).then(Response => {
			const count = Response.data
			reaction.parentElement.parentElement.querySelector("#reaction1").innerHTML = count[1]
			reaction.parentElement.parentElement.querySelector("#reaction2").innerHTML = count[2]
			reaction.parentElement.parentElement.querySelector("#reaction3").innerHTML = count[3]
			reaction.parentElement.parentElement.querySelector("#reaction4").innerHTML = count[4]
			reaction.parentElement.parentElement.querySelector("#reaction5").innerHTML = count[5]
			checkReaction(Response.data)
		})
	})
}
