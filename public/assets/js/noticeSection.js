function generateNotice(notice) {
    let result = "";
    for (let i = 0; i < notice.length; i++) {
        let content = `
        <article class="notice row mb-3 border-top">
            <form action="#" method="post">
                <p class="notice-text">${notice[i]["Message"]}</p>
        `;
        if (notice[i]["Read"] == 0) {
            content += `
                <button class="btn btn-success" type="submit" name="Read" value="${notice[i]["NotificationID"]}">Leggi</button>
            `;
        } else {
            content += `
                <button class="btn btn-success" type="submit" name="Read" value="${notice[i]["NotificationID"]}" disabled>Letto</button>
            `;
        }
        content += `
                <button class="btn btn-danger" type="submit" name="cancella" value="${notice[i]["NotificationID"]}">Cancella</button>
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
    if (main) {
        main.innerHTML = notice;
    }
});