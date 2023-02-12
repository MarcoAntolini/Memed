function generateNotice(notice) {
    let result = "";
    for (let i = 0; i < notice.length; i++) {
        let content = `
        <article class="notice row">
            <form action="#" method="post">
                <p class="notice">${notice[i]["mesaggio"]}</p>
        `;
        if (notice[i]["letto"] == 0) {
            content += `
                <button class="btn btn-primary" type="submit" name="letto" value="${notice[i]["idnotifica"]}">Leggi</button>
            `;
        } else {
            content += `
                <button class="btn btn-primary" type="submit" name="letto" value="${notice[i]["idnotifica"]}" disabled>Letto</button>
            `;
        }
        content += `
                <button class="btn btn-primary" type="submit" name="cancella" value="${notice[i]["idnotifica"]}">Cancella</button>
            </form>
        </article>
        `;
        result += content;
    }
    return result;
}

axios.get("noticeSection.php").then(Response => {
    console.log(Response.data);
    const notice = generateNotice(Response.data);
    const main = document.getElementById("notice-section");
    main.innerHTML = notice;
});