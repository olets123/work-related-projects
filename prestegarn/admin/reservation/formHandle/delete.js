if (id != null) {
    let mDiv = document.getElementById('messageDiv');
    deleteReservation(id).then(data => {
        mDiv.innerHTML += `<p>${data.statusText}</p><a href="reservation.php">tilbake til reservasjoner</a>`;
    }).catch(err => {
        mDiv.innerHTML += `<p>${data.statusText} Error: ${ err.error }</p><a href="reservation.php">tilbake til reservasjoner</a>`;
    });
}
var deleted = false;
function deleteReservation (idToDelete) {
    return new Promise ((res, rej) => {
        fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/reservation/delete.php`, {
            method: 'DELETE',
            body: JSON.stringify({reservationId: idToDelete})
        }).then(data => {
            if (data.statusText == 'OK') {
                res({'statusText': 'Reservasjon slettet!'});
                deleted = true;
            }
        }).catch(err => {
            rej({'statusText': 'Reservasjon ikke slettet!', error: err});
            deleted = false;
        })
    })
}