// set up csrf token for ajax use
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

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
    let formData = new FormData();
    formData.append('file', $('#upload_image')[0].files[0])

    let update = $('#upload_image').val();
    $.ajax({
        url: '/update-bgwallpaper',
        type: 'POST',
        data: formData
        ,
        processData : false,
        contentType : false,

        success: function(response) {
            if (response.success) { 
                alert('Wallpaper updated successfully!');
                // location.reload();
            } else {
                alert('Failed to update wallpaper.');
            }
        },
        error: function() {
            alert('An error occurred while updating the wallpaper.');
        }
    });
});


 const icons = {
    success: `<svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8l3.5 3.5L13 4.5" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/></svg>`,
    info:    `<svg width="16" height="16" viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="1.5"/><path d="M8 7v4M8 5.5v.5" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/></svg>`,
    warning: `<svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M8 2.5L14 13H2L8 2.5z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><path d="M8 6v3.5M8 11v.5" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/></svg>`,
    error:   `<svg width="16" height="16" viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="1.5"/><path d="M5.5 5.5l5 5M10.5 5.5l-5 5" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/></svg>`,
    default: '',
  };
  const closeIcon = `<svg width="13" height="13" viewBox="0 0 14 14" fill="none"><path d="M2 2l10 10M12 2L2 12" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/></svg>`;

  function showToast(message, type = 'default') {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.setAttribute('data-type', type);
    toast.innerHTML = `
      ${icons[type] ? `<span class="toast-icon">${icons[type]}</span>` : ''}
      <span class="toast-msg">${message}</span>
      <span class="toast-x">${closeIcon}</span>
    `;

    container.prepend(toast);
    requestAnimationFrame(() => requestAnimationFrame(() => toast.classList.add('show')));

    const dismiss = () => {
      toast.classList.add('hide');
      toast.classList.remove('show');
      setTimeout(() => toast.remove(), 250);
    };

    toast.addEventListener('click', dismiss);
    setTimeout(dismiss, 4000);
  }

    // ── Modal ──────────────────────────────────────────────
  function openModal(id) {
    const el = document.getElementById('modal-' + id);
    el.classList.add('open');
   
    document.addEventListener('keydown', escHandler);
    el._escHandler = escHandler;
    function escHandler(e) {
      if (e.key === 'Escape') closeModal(id);
    }
  }

  function closeModal(id) {
    const el = document.getElementById('modal-' + id);
    el.classList.remove('open');
    document.removeEventListener('keydown', el._escHandler);
  }

  function overlayClick(e, id) {
    if (e.target === e.currentTarget) closeModal(id);
  }

