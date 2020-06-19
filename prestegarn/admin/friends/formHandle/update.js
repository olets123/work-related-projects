
/**
 * makes fetch of type PUT to update friend table in the database through the API
 * @param {object} obj data to be changed
 */
function sendFriendObj(obj) {
    obj = JSON.stringify(obj);
    return new Promise((res, rej) => {
        fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/friends/update.php`, {
            method: 'PUT',
            body: obj
        }).then(data => {
            res([true, data.statusText]);
        }).catch(err => {
            rej([false, err]);
        })
    })
}