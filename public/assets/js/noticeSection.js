function generateNotice(notice) {
    let result = "";
    for (let i = 0; i < notice.length; i++) {
        let content = `
        <article class="notice row">
            <p class="notice">${notice[i]["mesaggio"]}</p>
            <button class="btn btn-primary" type="button" name="letto" value="${notice[i]["idnotifica"]}">letto</button>
            <button class="btn btn-primary" type="button" name="cancella" value="${notice[i]["idnotifica"]}">cancella</button>
            <!-- se notifica è richiesta allora bottoni accetta e rifiuta -->
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