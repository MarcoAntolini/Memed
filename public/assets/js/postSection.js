function generatePost(post) {
    let result = "";
    for (let i = 0; i < post.length; i++) {
        let content = `
        <div class="post container">
            <div class="left-up">
                <a class="username-post-owner" href="user.php?username=${post[i]["username"]}">${post[i]["username"]}</a>
                <img class="post-settings" src="" alt="">
                <div class="reactions">
                    <div class="1">
                        <img src="" alt="">
                        <span class="reaction-count">${post[i]["reazione1"]}</span>
                    </div>
                    <div class="2">
                        <img src="" alt="">
                        <span class="reaction-count">${post[i]["reazione2"]}</span>
                    </div>
                    <div class="3">
                        <img src="" alt="">
                        <span class="reaction-count">${post[i]["reazione3"]}</span>
                    </div>
                    <div class="4">
                        <img src="" alt="">
                        <span class="reaction-count">${post[i]["reazione4"]}</span>
                    </div>
                    <div class="5">
                        <img src="" alt="">
                        <span class="reaction-count">${post[i]["reazione5"]}</span>
                    </div>
                </div>
            </div>
            <div class="mid">
                <img class="post-image" src="${post[i]["nomefile"]}" alt="">
                <p class="post-text">${post[i]["testo"]}</p>
            </div>
            <div class="right-down">
                <div class="comments-section">
                    <?php foreach (${post[i]["commenti"]} as $commento): ?>
                    <div class="comment">
                        <a class="username-comment-owner" href="user.php?username=${commento["username"]}">${commento["username"]}</a>
                        <p class="comment-text">${commento["testo"]}</p>
                    </div>
                    <?php endforeach; ?>
                </div>
                <form class="add-comment" method="post" action="#">
                    <input class="comment-input" type="text" name="comment-text" placeholder="Commenta...">
                    <input type="hidden" name="idpost" value="${post[i]["idpost"]}">
                    <button class="post-comment btn btn-primary" type="button" name="post-comment">Pubblica</button>
                </form>
            </div>
        </div>
        `;
        result += content;
    }
    return result;
}

axios.get("api-postHome.php").then(Response => {
    const post = generatePost(Response.data);
    const main = document.getElementById("post-section");
    main.innerHTML = post;
});