
/**
 * makes fetch of type PUT to update about table in the database through the API
 * @param {object} obj data to be changed
 */
function sendReservationObj(obj) {
    obj = JSON.stringify(obj);
    console.log(obj);
    return new Promise((res, rej) => {
        fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/reservation/update.php`, {
            method: 'PUT',
            body: obj
        }).then(data => {
            res([true, data.statusText]);
        }).catch(err => {
            rej([false, err]);
        })
    })
}