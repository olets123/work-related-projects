/**
 * when all fetch requests are resolved create class. 
 * @param idToGet defined in news.php from url
*/
function defineObjects(idToGet) {
    return new Promise((res, rej) => {
        getSingluarTag(idToGet).then((data) => {
            this.isLoaded = true;
            let tagObj = data;
            res(tagObj);
            }, (error) => {
                isLoaded = true;
                rej(error);
        });
    })
}

/* GET news*/

/**
 * Fetch all required newsinformation from database
 * @param {int} id get news with this id
 * @returns promise, when resolved returns tagObj;
 */
function getSingluarTag(id) {
    return new Promise ((res, rej) => {
        let tagObj = [];
        let tagPromise = fetchCtrl([fetchSingleTag(id)]);
        tagPromise.then((data) => {
            tagObj = data[0];
            res(tagObj);
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
 * resolves fetch request for newss
 * @param {int} id of news to fetch
 * @returns promise, that is resolved on the completion of the fetch request
 */
function fetchSingleTag (id)  {
    return Promise.resolve(fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/tags/read_single.php?id=${id}`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data;
    }).catch((error) => { console.error(error);}))   
}

