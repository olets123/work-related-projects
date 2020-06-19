if (id != null) {
    let mDiv = document.getElementById('messageDiv');
    deleteFriend(id).then(data => {
        mDiv.innerHTML += `<p>${data.statusText}</p><a href="friends.php">tilbake til våre venner</a>`;
    }).catch(err => {
        mDiv.innerHTML += `<p>${data.statusText} Error: ${ err.error }</p><a href="friends.php">tilbake til våre venner</a>`;
    });
}

var deleted = false;
function deleteFriend (idToDelete) {
    console.log(idToDelete);
    return new Promise ((res, rej) => {
        fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/friends/delete.php`, {
            method: 'DELETE',
            body: JSON.stringify({friendId: idToDelete})
        }).then(data => {
            if (data.statusText == 'OK') {
                res({'statusText': 'Venn slettet!'});
                deleted = true;
            }
        }).catch(err => {
            rej({'statusText': 'Venn ikke slettet!', error: err});
            deleted = false;
        })
    })
}