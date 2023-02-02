function generaPost(post){
    let result = "";

    for(let i=0; i < post.length; i++){
        let post = `
        <article>
            <header>
                <div>
                    <img src="${post[i]["imgarticolo"]}" alt="" />
                </div>
                <h2>${articoli[i]["titoloarticolo"]}</h2>
                <p>${articoli[i]["nome"]} - ${articoli[i]["dataarticolo"]}</p>
            </header>
            <section>
                <p>${articoli[i]["anteprimaarticolo"]}</p>
            </section>
            <footer>
                <a href="articolo.php?id=${articoli[i]["idarticolo"]}">Leggi tutto</a>
            </footer>
        </article>

        <div class="post container">
    <div class="left-up">
        <a class="username-post-owner" href="utente.php?id=${post[i]["username"]}">${post[i]["username"]}</a>
        <img class="post-settings" src="${post[i]["nomefile"]}" alt="">
        <div class="reactions">
            <div class="1">
                <img src="" alt="">
                <span class="reaction-count"></span>
            </div>
            <div class="2">
                <img src="" alt="">
                <span class="reaction-count"></span>
            </div>
            <div class="3">
                <img src="" alt="">
                <span class="reaction-count"></span>
            </div>
            <div class="4">
                <img src="" alt="">
                <span class="reaction-count"></span>
            </div>
            <div class="5">
                <img src="" alt="">
                <span class="reaction-count"></span>
            </div>
        </div>
    </div>
    <div class="mid">
        <img class="post-image" src="" alt="">
        <p class="post-text"></p>
    </div>
    <div class="right-down">
        <div class="caption">
            <p class="caption-text"></p>
        </div>
        <div class="comments-section">
            <!-- questa tra commenti è la parte che si ripete per ogni commento -->
            <div class="comment">
                <a class="username-comment-owner" href=""></a>
                <p class="comment-text"></p>
            </div>
            <!--  -->
        </div>
        <div class="add-comment">
            <input class="comment-input" type="text" placeholder="Commenta...">
            <button class="post-comment btn btn-primary" type="button">Pubblica</button>
        </div>
    </div>
</div>

<!-- 
    TODO:
    dividere in due:
    se è un post con immagine ci va caption ma non post-text, altrimenti viceversa
-->
        `;
        result += articolo;
    }
    return result;
}

axios.get("api-postHome.php").then(Response => {
    console.log(Response);
    const post = generaPost(Response.data);
    const main = document.querySelector("main");
    main.innerHTML = post;
})