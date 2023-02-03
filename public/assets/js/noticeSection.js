function generateNotice(notice) {
    let result = "";
    for (let i = 0; i < notice.length; i++) {
        let content = `
        <div class="notice row">
            <p class="notice">${notice[i]["messaggio"]}</p>
            <input type="checkbox" name="letto" value="${notice[i]["idnotifica"]}"> <!-- segna come letta -->
            <input type="checkbox" name="cancella" value="${notice[i]["idnotifica"]}">
            <!-- se notifica è richiesta allora bottoni accetta e rifiuta -->
        </div>
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