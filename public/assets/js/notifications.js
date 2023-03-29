window.onload = () => {
	const notifications = document.getElementById("notifications-number")
	const notificationsNumber = notifications ? notifications.value : 0
	const notification = document.getElementById("notification-Id")
	const notificationId = notification ? notification.value : false
	const readAllButton = document.getElementById("readall")
	const clearAllButton = document.getElementById("clearall")
	if (notificationsNumber == 0 && readAllButton) readAllButton.disabled = true
	if (notificationsNumber == 0 && clearAllButton) clearAllButton.disabled = true
	if (!notificationId && clearAllButton) clearAllButton.disabled = true
}
