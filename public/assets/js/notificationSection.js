const requestInterval = 1000
let idx

window.addEventListener("load", () => getNotifications())

setInterval(getNotifications, requestInterval)

function getNotifications() {
	const isMobile = window.getComputedStyle(document.querySelector(".offcanvas")).display === "none"
	idx = isMobile ? 1 : 0
	if (window.location.pathname.includes("notificationPage.php") && idx == 0) window.location.href = "index.php"
	axios.get("notificationApi.php", { params: { type: "section" } }).then((Response) => {
		const notification = generatenotification(Response.data)
		const main = document.querySelectorAll("#notification-section")[idx]
		if (main && notification) main.innerHTML = notification
	})
}

function generatenotification(notification) {
	let content = ""
	if (!notification) return
	for (const element of notification) {
		content += `
        <article class="notification row mb-3 border-bottom">
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
