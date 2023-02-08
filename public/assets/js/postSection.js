function generatePost(post) {
    let result = "";
    for (let i = 0; i < post.length; i++) {
        let content = `
        <div class="post container">
            <div class="left-up">
                <a class="username-post-owner" href="user.php?username=${post[i]["username"]}">${post[i]["username"]}</a>
                <img src="../public/assets/img/user-settings.png" alt="post-settings" data-bs-toggle="modal" data-bs-target=".post-settings">
                <div class="post-settings modal fade" role="dialog" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1">
                <div id="post-settings" class="modal-dialog modal-dialog-scrollable modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form class="action-post" action="#" method="post">
                        <input type="hidden" name="idpost" value="${post[i]["idpost"]}">`;
        if (post[i]["username"] == post[i]["session-username"]) {
            content += `
                        <button class="edit-post btn btn-primary" type="button" name="edit-post">Modifica</button>
                        <!--TODO: il bottone qui sopra apre qualcosa per modificare il post-->
                        <button class="delete-post btn btn-danger" type="submit" name="delete-post">Elimina</button>
            `;
        } else {
            content += `
                        <button class="save-post btn btn-primary" type="submit" name="save-post">Salva</button>
                        <button class="report-post btn btn-warning" type="submt" name="report-post">Segnala</button>
            `;
        }
        content += `
                        </form >
                        </div >
                    </div >
                </div >
            </div >
            <form class="reaction-post" action="#" method="post">
                <div class="reactions">
                    <div class="1">
                        <img src="../public/assets/img/reazione-1.png" alt="reazione-1" class="reaction">
                            <span class="reaction-count">${post[i]["reazione1"]}</span>
                    </div>
                    <div class="2">
                        <img src="../public/assets/img/reazione-2.png" alt="reazione-2" class="reaction">
                            <span class="reaction-count">${post[i]["reazione2"]}</span>
                    </div>
                    <div class="3">
                        <img src="../public/assets/img/reazione-3.png" alt="reazione-3" class="reaction">
                            <span class="reaction-count">${post[i]["reazione3"]}</span>
                    </div>
                    <div class="4">
                        <img src="../public/assets/img/reazione-4.png" alt="reazione-4" class="reaction">
                            <span class="reaction-count">${post[i]["reazione4"]}</span>
                    </div>
                    <div class="5">
                        <img src="../public/assets/img/reazione-5.png" alt="reazione-5" class="reaction">
                            <span class="reaction-count">${post[i]["reazione5"]}</span>
                    </div>
                </div>
            </form>
            </div >
            <div class="mid">
                <img class="post-image" src="${post[i]["nomefile"]}" alt="">
                <p class="post-text">${post[i]["testo"]}</p>
            </div>
            <div class="right-down">
                <div class="comments-section">   
        `;
        if (post[i]["commenti"]) {
            post[i]["commenti"].forEach(commento => {
                content += `
                    <div class="comment">
                        <a class="username-comment-owner" href="user.php?username=$commento["username"]">${commento["username"]}</a>
                        <p class="comment-text">${commento["testo"]}</p>
                    </div>
            `;
            });
        }
        content += `
                </div >
            <form class="add-comment" method="post" action="#">
                <input class="comment-input" type="text" name="comment-text" placeholder="Commenta...">
                    <input type="hidden" name="idpost" value="${post[i][" idpost"]}">
                    <button class="post-comment btn btn-primary" type="button" name="post-comment">Pubblica</button>
            </form>
            </div >
        </div >
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
    }
    return url;
}

axios.get("postSection.php", { params: { url: checkPage() } }).then(Response => {
    console.log("🚀 ~ file: postSection.js:108 ~ axios.get ~ Response", Response);
    const post = generatePost(Response.data);
    const main = document.getElementById("post-section");
    main.innerHTML = post;
});