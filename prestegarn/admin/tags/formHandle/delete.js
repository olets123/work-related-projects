if (id != null) {
    let mDiv = document.getElementById('messageDiv');
    deleteTag(id).then(data => {
        mDiv.innerHTML += `<p>${data.statusText}</p><a href="tags.php">tilbake til knagger</a>`;
    }).catch(err => {
        mDiv.innerHTML += `<p>${data.statusText} Error: ${ err.error }</p><a href="tags.php">tilbake til knagger</a>`;
    });
}
var deleted = false;
function deleteTag (idToDelete) {
    return new Promise ((res, rej) => {
        fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/tags/delete.php`, {
            method: 'DELETE',
            body: JSON.stringify({tagId: idToDelete})
        }).then(data => {
            if (data.statusText == 'OK') {
                res({'statusText': 'Knagg slettet!'});
                deleted = true;
            }
        }).catch(err => {
            rej({'statusText': 'Knagg ikke slettet!', error: err});
            deleted = false;
        })
    })
}