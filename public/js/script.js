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


setInterval(updateClock, 1000);



$('#upload_image').on('change', function() {
    console.log('Updating wallpaper...');
    // if(!$('#image_input').val()) {
    //     alert('Please select an image to upload.');
    //     return;
    // }

    let update = $('#upload_image').val();
    $.ajax({
        url: '/update-bgwallpaper',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            update: update
        },
        success: function(response) {
            if (response.success) { 
                alert('Wallpaper updated successfully!');
                location.reload();
            } else {
                alert('Failed to update wallpaper.');
            }
        },
        error: function() {
            alert('An error occurred while updating the wallpaper.');
        }
    });
});
