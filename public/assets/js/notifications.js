window.addEventListener("load", () => getData())

setInterval(getData, 10000)

function getData() {
	axios.get("notificationApi.php", { params: { type: "buttons" } }).then(Response => {
		const unreadNotificationsNumber = Response.data.unreadNotificationsNumber
		const notificationsNumber = Response.data.notificationsNumber
		const notifications = Response.data.notifications

		const unreadNotificationCountSpan = document.getElementById("unread-notification-number")
		if (unreadNotificationCountSpan) unreadNotificationCountSpan.innerHTML = unreadNotificationsNumber

		const readAllButton = document.getElementById("readall")
		if (readAllButton) readAllButton.disabled = unreadNotificationsNumber == 0 || !notifications

		const clearAllButton = document.getElementById("clearall")
		if (clearAllButton) clearAllButton.disabled = notificationsNumber == 0 || !notifications
	})
}
