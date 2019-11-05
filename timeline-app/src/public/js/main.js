function reloadPage() {
    document.location.reload();
}

function requestNotShownEventsCount() {
    return new Promise((resolve) => {
        $.getJSON("/ajax/types.php?mark=" + $('#alert-not-shown-types').attr('datetime-mark') , data => {
            const { notShownEventsCount } = data;
            resolve(notShownEventsCount);
        });
    });
}

async function displayNotShownEventsAlertIfNeed() {
    const notShownEventsCount = await requestNotShownEventsCount();
    if (notShownEventsCount > 0) {
        $('#empty-message').hide();
        $('#alert-not-shown-types').show();
    }
}

$(document).ready(async () => {
    setInterval(displayNotShownEventsAlertIfNeed, 10000);
    $('#alert-not-shown-types').click(() => {
       reloadPage();
       return false;
    });
});
