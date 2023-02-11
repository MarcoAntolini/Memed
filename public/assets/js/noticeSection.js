function generateNotice(notice) {
    let result = "";
    for (let i = 0; i < notice.length; i++) {
        let content = `
        <article class="notice row">
            <form action="#" method="post">
                <p class="notice">${notice[i]["mesaggio"]}</p>
                <button class="btn btn-primary" type="submit" name="letto" value="${notice[i]["idnotifica"]}">Letto</button>
                <button class="btn btn-primary" type="submit" name="cancella" value="${notice[i]["idnotifica"]}">Cancella</button>
            </form>
        </article>
        `;
        result += content;
    }
    return result;
}

axios.get("noticeSection.php").then(Response => {
    const notice = generateNotice(Response.data);
    const main = document.getElementById("notice-section");
    main.innerHTML = notice;
});