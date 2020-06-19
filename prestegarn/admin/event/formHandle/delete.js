if (id != null) {
    let mDiv = document.getElementById('messageDiv');
    deleteEvent(id).then(data => {
        mDiv.innerHTML += `<p>${data.statusText}</p><a href="events.php">tilbake til arrangementer</a>`;
    }).catch(err => {
        mDiv.innerHTML += `<p>${data.statusText} Error: ${ err.error }</p><a href="events.php">tilbake til arrangementer</a>`;
    });
}
var deleted = false;
function deleteEvent (idToDelete) {
    console.log(idToDelete);
    return new Promise ((res, rej) => {
        fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/event/delete.php`, {
            method: 'DELETE',
            body: JSON.stringify({eventId: idToDelete})
        }).then(data => {
            if (data.statusText == 'OK') {
                res({'statusText': 'Arrangement slettet!'});
                deleted = true;
            }
        }).catch(err => {
            rej({'statusText': 'Arrangement ikke slettet!', error: err});
            deleted = false;
        })
    })
}