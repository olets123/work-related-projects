
/**
 * makes fetch of type PUT to update news table in the database through the API
 * @param {object} obj data to be changed
 */
function sendNewsObj(obj) {
    obj = JSON.stringify(obj);
    console.log(obj);
    return new Promise((res, rej) => {
        fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/news/update.php`, {
            method: 'PUT',
            body: obj
        }).then(data => {
            res([true, data.statusText]);
        }).catch(err => {
            rej([false, err]);
        })
    })
}