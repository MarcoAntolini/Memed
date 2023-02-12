function generatePost(post) {
    let result = "";
    for (let i = 0; i < post.length; i++) {
        let content = `
        <div class="post card mb-3">
            <div class="row g-0">
                <div class="col-md-2 p-2">
                    <a class="username-post-owner" href="user.php?username=${post[i]["username"]}">@${post[i]["username"]}</a>
                    <img src="../public/assets/img/user-settings.png" alt="post-settings" data-bs-toggle="modal"
                        data-bs-target=".post-settings-${post[i]["idpost"]}" class="post-settings-icon">
                    <div class="post-settings-${post[i]["idpost"]} modal fade" role="dialog" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1">
                        <div id="post-settings" class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="action-post" action="#" method="post">
                                        <input type="hidden" name="idpost" value="${post[i]["idpost"]}">`;
        if (post[i]["username"] == post[i]["session-username"]) {
            content += `
                                        <button class="edit-post btn btn-primary" type="button" id="edit-button"
                                                data-bs-toggle="collapse" data-bs-target="#edit-post"
                                                aria-expanded="false" aria-controls="edit-post">
                                            Modifica
                                        </button>
                                        <button class="delete-post btn btn-danger" type="button" id="delete-button"
                                                data-bs-toggle="collapse" data-bs-target="#delete-post"
                                                aria-expanded="false" aria-controls="delete-post">
                                            Elimina
                                        </button>
                                        <div class="collapse" id="edit-post">
                                            <div class="card card-body">
                                                <form action="#" method="post" enctype="multipart/form-data">
                                                    <label for="edit-post-text">Descrizione:</label>
                                                    <textarea id="edit-post-text" name="description" rows="10">${post[i]["testo"]}</textarea>
                                                    <input type="hidden" name="idpost" value="${post[i]["idpost"]}">
                                                    <button type="reset" name="reset" class="btn btn-secondary">Annulla</button>
                                                    <button type="submit" name="edit-post" class="btn btn-primary mb-3">Salva</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="collapse" id="delete-post">
                                            <div class="card card-body">
                                                <form action="#" method="post" enctype="multipart/form-data">
                                                    <p>Sei sicuro di voler eliminare questo post?</p>
                                                    <input type="hidden" name="idpost" value="${post[i]["idpost"]}">
                                                    <button type="submit" name="delete-post" class="btn btn-danger">Elimina</button>
                                                </form>
                                            </div>
                                        </div>
            `;
        } else {
            if (!post[i]["controllaSalva"]) {
                content += `
                                        <button class="save-post btn btn-primary" type="submit" name="save-post">Salva</button>
                `;
            } else {
                content += `
                                        <button class="unsave-post btn btn-primary" type="submit" name="unsave-post">Rimuovi</button>
                `;
            }
            content += `
                                        <button class="report-post btn btn-warning" type="submt" name="report-post">Segnala</button>
            `;
        }
        content += `
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="reaction-post" action="#" method="post">
                        <input type="hidden" id="idpost" name="idpost" value="${post[i]["idpost"]}">
                        <input type="hidden" id="username" name="username" value="${post[i]["session-username"]}">
                        <div class="reactions">
                            <div class="reaction-5">
                                <img src="../public/assets/img/reazione-5.png" alt="reazione-5" class="reaction-image ${post[i]["reazione-attiva-5"]}">
                                <span id="reazione5" class="reaction-count">${post[i]["reazione5"]}</span>
                            </div>
                            <div class="reaction-4">
                                <img src="../public/assets/img/reazione-4.png" alt="reazione-4" class="reaction-image ${post[i]["reazione-attiva-4"]}">
                                <span id="reazione4" class="reaction-count">${post[i]["reazione4"]}</span>
                            </div>
                            <div class="reaction-3">
                                <img src="../public/assets/img/reazione-3.png" alt="reazione-3" class="reaction-image ${post[i]["reazione-attiva-3"]}">
                                <span id="reazione3" class="reaction-count">${post[i]["reazione3"]}</span>
                            </div>
                            <div class="reaction-2">
                                <img src="../public/assets/img/reazione-2.png" alt="reazione-2" class="reaction-image ${post[i]["reazione-attiva-2"]}">
                                <span id="reazione2" class="reaction-count">${post[i]["reazione2"]}</span>
                            </div>
                            <div class="reaction-1">
                                <img src="../public/assets/img/reazione-1.png" alt="reazione-1" class="reaction-image ${post[i]["reazione-attiva-1"]}">
                                <span id="reazione1" class="reaction-count">${post[i]["reazione1"]}</span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 border-start border-end p-2">
                    <img class="post-image" src="${post[i]["nomefile"]}" alt="">
                    <p class="post-text">${post[i]["testo"]}</p>
                </div>
                <div class="col-md-4 p-2">
                    <div class="comments-section">   
        `;
        if (post[i]["commenti"]) {
            post[i]["commenti"].forEach(commento => {
                content += `
                        <div class="comment">
                            <a class="username-comment-owner" href="user.php?username=${commento["username"]}">@${commento["username"]}</a>
                            <p class="comment-text">${commento["testo"]}</p>
                        </div>
            `;
            });
        }
        content += `
                    </div>
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".post-comment-${post[i]["idpost"]}">Commenta</button>
                    <div class="post-comment-${post[i]["idpost"]} modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel"
                        aria-hidden="true" role="dialog"
                        data-bs-keyboard="false" data-bs-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="add-comment" method="post" action="#">
                                        <textarea class="comment-input" type="text" name="comment-text" placeholder="Commenta..." rows="3"></textarea>
                                        <input type="hidden" name="idpost" value="${post[i]["idpost"]}">
                                        <button class="submit-comment btn btn-primary mb-3" type="submit" name="submit-comment">Pubblica</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
        result += content;
    };
    return result;
}

function checkPage() {
    const windowPath = window.location.pathname;
    let url = "";
    if (windowPath.includes("index.php")) {
        url = "index.php";
    } else if (windowPath.includes("explore.php")) {
        url = "explore.php";
    } else if (windowPath.includes("user.php")) {
        url = "user.php";
    } else if (windowPath.includes("saved.php")) {
        url = "saved.php";
    }
    return url;
}

axios.get("postSection.php", { params: { url: checkPage() } }).then(Response => {
    const post = generatePost(Response.data);
    const main = document.getElementById("post-section");
    main.innerHTML = post;
    handlePost();
    handleReactions();
});

function handlePost() {
    const editButton = document.getElementById("edit-button");
    const deleteButton = document.getElementById("delete-button");
    if (editButton && deleteButton) {
        const editDiv = document.getElementById("edit-post");
        const deleteDiv = document.getElementById("delete-post");
        editButton.addEventListener("click", function () {
            checkCollapsibles(editButton, deleteButton, deleteDiv);
        });
        deleteButton.addEventListener("click", function () {
            checkCollapsibles(deleteButton, editButton, editDiv);
        });
    }
}

function checkCollapsibles(buttonClicked, buttonChecked, divChecked) {
    if (!buttonClicked.classList.contains("collapsed") && !buttonChecked.classList.contains("collapsed")) {
        divChecked.classList.remove("show");
    }
}

function handleReactions() {
    const reactions = document.querySelectorAll(".reaction-image");
    reactions.forEach(reaction => {
        reaction.addEventListener("click", function () {
            if (reaction.classList.contains("active")) {
                reaction.classList.remove("active");
            } else {
                const oldReaction = reaction.parentElement.parentElement.querySelector(".active");
                if (oldReaction) {
                    oldReaction.classList.remove("active");
                }
                reaction.classList.add("active");
            }
            if (reaction.parentElement.classList.contains("reaction-1")) {
                addReaction(reaction, 1);
            } else if (reaction.parentElement.classList.contains("reaction-2")) {
                addReaction(reaction, 2);
            } else if (reaction.parentElement.classList.contains("reaction-3")) {
                addReaction(reaction, 3);
            } else if (reaction.parentElement.classList.contains("reaction-4")) {
                addReaction(reaction, 4);
            } else if (reaction.parentElement.classList.contains("reaction-5")) {
                addReaction(reaction, 5);
            }
        });
    });
}

function addReaction(reaction, idreazione) {
    const idpost = reaction.parentElement.parentElement.parentElement.querySelector("#idpost").value;
    const username = reaction.parentElement.parentElement.parentElement.querySelector("#username").value;
    axios.post("reactionSection.php", { idreazione: idreazione, idpost: idpost, username: username }).then({
    });
    axios.get("reactionSection.php", { params: { idpost: idpost } }).then(Response => {
        const count = Response.data;
        reaction.parentElement.parentElement.querySelector("#reazione1").innerHTML = count[1];
        reaction.parentElement.parentElement.querySelector("#reazione2").innerHTML = count[2];
        reaction.parentElement.parentElement.querySelector("#reazione3").innerHTML = count[3];
        reaction.parentElement.parentElement.querySelector("#reazione4").innerHTML = count[4];
        reaction.parentElement.parentElement.querySelector("#reazione5").innerHTML = count[5];
        // TODO: reazione-attiva da reactionSection.php
    });
}
