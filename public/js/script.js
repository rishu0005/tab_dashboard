{/* <script> */}
function updateClock() {
    const now = new Date();

    let hours = now.getHours();
    let minutes = now.getMinutes();
    let period = hours >= 12 ? 'PM' : 'AM';

    hours = hours % 12 || 12; // convert 0 → 12
    minutes = minutes < 10 ? '0' + minutes : minutes;

    const timeString = `${hours}:${minutes}`;

    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const dateString = now.toLocaleDateString(undefined, options);

    document.getElementById('clockTime').childNodes[0].nodeValue = timeString + ' ';
    document.getElementById('clockP').textContent = period;
    document.getElementById('clockDate').textContent = dateString;
}

// run immediately
updateClock();

// update every second
setInterval(updateClock, 1000);
// </script>