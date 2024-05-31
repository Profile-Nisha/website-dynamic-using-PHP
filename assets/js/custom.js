function updateTime() {
    // Get the current date and time
    var currentDate = new Date();

    // Format the date and time as desired
    var formattedDate = currentDate.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
    var formattedTime = currentDate.toLocaleTimeString('en-US');

    // Update the content of the <p> element
    document.getElementById('date-time').innerText = formattedDate + ' ' + formattedTime;
}

// Call updateTime initially to set the time
updateTime();

// Update the time every second
setInterval(updateTime, 1000);