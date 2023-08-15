function updateDateTime() {
    const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    const now = new Date();

    const currentWeekday = daysOfWeek[now.getDay()];
    const currentMonth = months[now.getMonth()];
    const currentDay = now.getDate();
    const currentYear = now.getFullYear();
    const currentTime = now.toLocaleTimeString();

    const formattedDate = `${currentMonth} ${currentDay}, ${currentYear}`;

    document.getElementById('currentDateTime').textContent = `${currentWeekday}` + ` ${formattedDate}` + ` ${currentTime}`;
}

// Initial call to update the time
updateDateTime();

// Update the time every second
setInterval(updateDateTime, 1000);
