window.addEventListener("load", () => getData())

setInterval(getData, requestInterval)

function getData() {
	axios.get("notificationApi.php", { params: { type: "buttons" } }).then((Response) => {
		const unreadNotificationsNumber = Response.data.unreadNotificationsNumber
		const notificationsNumber = Response.data.notificationsNumber
		const notifications = Response.data.notifications

		const unreadNotificationCountSpan = document.querySelectorAll("#unread-notification-number")[idx]
		if (unreadNotificationCountSpan) unreadNotificationCountSpan.innerHTML = unreadNotificationsNumber

		const unreadBadge = document.querySelectorAll("#unread-badge-counter")[idx]
		if (unreadBadge) unreadBadge.style.display = unreadNotificationsNumber == 0 ? "none" : "block"
		if (unreadBadge) unreadBadge.innerText = unreadNotificationsNumber

		const readAllButton = document.querySelectorAll("#readall")[idx]
		if (readAllButton) readAllButton.disabled = unreadNotificationsNumber == 0 || !notifications

		const clearAllButton = document.querySelectorAll("#clearall")[idx]
		if (clearAllButton) clearAllButton.disabled = notificationsNumber == 0 || !notifications
	})
}
