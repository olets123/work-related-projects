/**
 * when all fetch requests are resolved put data gotten into their respected input fields, etc. 
 * @param id defined in events.php from url
*/
function defineObjects(idToGet) {
    return new Promise((res, rej) => {
        getSingularHistory(idToGet).then((data) => {
            this.isLoaded = true;
            let historyObj = data;
            res(historyObj);
            }, (error) => {
                isLoaded = true;
                rej(error);
        });
    })
}
/* GET EVENT */

/**
 * Fetch all required event information from database
 * @param {int} id get event with this id
 * @returns promise, when resolved returns three objects (historyObj, friendObj, and tagObj);
 */
function getSingularHistory (id) {
    return new Promise ((res, rej) => {
        let historyObj = [];
        let galleryObj = [];
        let historyPromise = fetchCtrl([fetchSingleHistory(id), fetchSingleGallery(id, null)]);
        historyPromise.then((data) => {
            historyObj = data[0];
            galleryObj = data[1];

            historyObj.pictures = [];
            historyObj.pictures = galleryObj.filter(gallery => gallery.timeId === historyObj.timeId); 

            res(historyObj);
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
 * resolves fetch request for history
 * @param {int} id of history to fetch
 * @returns promise, that is resolved on the completion of the fetch request
 */
function fetchSingleHistory (id)  {
    return Promise.resolve(fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/history/read_single.php?id=${id}`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data;
    }).catch((error) => { console.error(error);}))   
}

/**
 * resolves fetch request for history gallery
 * @param {int} tId id of history to get gallery info about. 
 * @param {int} gId id of gallery to fetch
 * @returns promise, that is resolved on the completion of the fetch request
 */
function fetchSingleGallery (tId = null, gId = null)  {
    let fetchUrl = `${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/gallery/read_single.php?gId=1&tId=1`;
    if (gId != null && tId != null) fetchUrl = `${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/gallery/read_single.php?gId=${gId}&tId=${tId}`;
    else if (gId == null && tId != null) fetchUrl = `${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/gallery/read_single.php?tId=${tId}`;
    else if (gId != null && tId == null) fetchUrl = `${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/gallery/read_single.php?gId=${gId}`;
    return Promise.resolve(fetch(fetchUrl)
    .then(response => {
        if(response.ok) return response.json();
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}
