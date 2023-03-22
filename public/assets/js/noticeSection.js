function generateNotice(notice) {
	let result = ""
	if (!notice) return
	for (const element of notice) {
		let content = `
        <article class="notice row mb-3 border-top">
            <form action="#" method="post">
                <p class="notice-text">${element["Message"]}</p>
        `
		if (element["Read"] == 0) {
			content += `
                <button class="btn btn-success" type="submit" name="Read" value="${element["NotificationID"]}">Leggi</button>
            `
		} else {
			content += `
                <button class="btn btn-success" type="submit" name="Read" value="${element["NotificationID"]}" disabled>Letto</button>
            `
		}
		content += `
                <button class="btn btn-danger" type="submit" name="cancella" value="${element["NotificationID"]}">Cancella</button>
            </form>
        </article>
        `
		result += content
	}
	return result
}

axios.get("noticeSection.php").then(Response => {
	const notice = generateNotice(Response.data)
	const main = document.getElementById("notice-section")
	if (main && notice) main.innerHTML = notice
})
