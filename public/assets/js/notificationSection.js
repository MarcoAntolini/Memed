const requestInterval = 10000

window.addEventListener("load", () => getNotifications())

setInterval(getNotifications, requestInterval)

function getNotifications() {
	axios.get("notificationApi.php", { params: { type: "section" } }).then(Response => {
		const notification = generatenotification(Response.data)
		const main = document.getElementById("notification-section")
		if (main && notification) main.innerHTML = notification
	})
}

function generatenotification(notification) {
	let content = ""
	if (!notification) return
	for (const element of notification) {
		content += `
        <article class="notification row mb-3 border-top">
            <form action="#" method="post">
                <p class="notification-text">${element["Message"]}</p>
        `
		if (element["Read"] == 0) {
			content += `
                <button class="btn btn-success" type="submit" name="read" value="${element["NotificationID"]}">Leggi</button>
            `
		} else {
			content += `
                <button class="btn btn-success" type="submit" name="read" value="${element["NotificationID"]}" disabled>Letto</button>
            `
		}
		content += `
                <button class="btn btn-danger" type="submit" name="delete" value="${element["NotificationID"]}">Cancella</button>
            </form>
        </article>
        `
	}
	return content
}
