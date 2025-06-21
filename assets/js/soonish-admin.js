// soonish-admin.js placeholder

function soonishToggleMode(enabled, nonce) {
    fetch(ajaxurl, {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        },
        body: new URLSearchParams({
            action: 'soonish_toggle_mode',
            enabled: enabled ? 'true' : 'false',
            nonce: nonce
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Coming Soon mode is now ' + (enabled ? 'enabled' : 'disabled'));
        } else {
            alert('Error: ' + (data.data && data.data.message ? data.data.message : 'Unknown error'));
        }
    })
    .catch(() => alert('AJAX request failed.'));
} 