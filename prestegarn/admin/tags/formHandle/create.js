
/**
 * makes fetch of type POST to create an event table in the database through the API
 * @param {object} obj tagObj to be created
 */
function createTag(obj) {
    jsonObj = JSON.stringify(obj);
    console.log(jsonObj);
    return new Promise((res, rej) => {
        fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/tags/create.php`, {
            method: 'POST',
            body: jsonObj
        }).then(data => {
            res([true, data.statusText]);
        }).catch(err => {
            rej([false, err]);
        })
    })
}
