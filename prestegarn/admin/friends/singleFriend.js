/**
 * when all fetch requests are resolved put data gotten into their respected input fields, etc. 
 * @param id defined in friends.php from url
*/
function defineObjects(idToGet) {
    return new Promise((res, rej) => {
        getSingularFriend(idToGet).then((data) => {
            this.isLoaded = true;
            let friendObj = data;
            res(friendObj);
        }).catch(err => rej(err));
    })
}

/* GET FRIENDS */

/**
 * Fetch all required friend information from database
 * @param {int} id get friend with this id
 * @returns promise, when resolved returns the friendObj;
 */
function getSingularFriend (id) {
    return new Promise ((res, rej) => {
        let friendObj = [];
        let friendPromise = fetchCtrl([fetchSingleFriend(id)]);
        friendPromise.then((data) => {
            friendObj = data;
            res(friendObj);
        }).catch(error => { rej(() => { throw new Error(error)})});
    })
}

/**
 * resolves array of promises
 * @param {array} promises array of promises to be resolved
 * @returns promise, resolved when every promise in array of promises is resolved
 */
function fetchCtrl (promises) {
    return new Promise ((res, rej) => {
        Promise.all(promises).then((data) => { res(data)}).catch((error) => { rej(() => { throw new Error(error); })})
    })
}

/**
 * resolves fetch request for friends
 * @param {int} id of friend to fetch
 * @returns promise, that is resolved on the completion of the fetch request
 */
function fetchSingleFriend (id)  {
    return Promise.resolve(fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/friends/read_single.php?id=${id}`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data;
    }).catch((error) => { console.error(error);}))   
}