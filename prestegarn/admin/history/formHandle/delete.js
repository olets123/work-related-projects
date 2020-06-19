if (id != null) {
    let mDiv = document.getElementById('messageDiv');
    deleteHistory(id).then(data => {
        mDiv.innerHTML += `<p>${data.statusText}</p><a href="history.php">tilbake til historie</a>`;
    }).catch(err => {
        mDiv.innerHTML += `<p>${data.statusText} Error: ${ err.error }</p><a href="history.php">tilbake til historie</a>`;
    });
}
var deleted = false;
function deleteHistory (idToDelete) {
    console.log(idToDelete);
    return new Promise ((res, rej) => {
        fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/history/delete.php`, {
            method: 'DELETE',
            body: JSON.stringify({timeId: idToDelete})
        }).then(data => {
            if (data.statusText == 'OK') {
                res({'statusText': 'Historie element slettet!'});
                deleted = true;
            }
        }).catch(err => {
            rej({'statusText': 'Historie element ikke slettet!', error: err});
            deleted = false;
        })
    })
}