
/**
 * makes fetch of type POST to create an friend table in the database through the API
 * @param {object} obj friendObj to be created
 */
function createFriend(obj) {
    jsonObj = JSON.stringify(obj);
    return new Promise((res, rej) => {
        fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/friends/create.php`, {
            method: 'POST',
            body: jsonObj
        }).then(data => {
            res([true, 'venn lagd'])
        }).catch(err => {
            rej([false, err]);
        })
    })
}