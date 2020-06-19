/**
 * when all fetch requests are resolved create class. 
 * @param idToGet defined in about.php from url
*/
function defineObjects(idToGet) {
    return new Promise((res, rej) => {
        getSingularAbout(idToGet).then((data) => {
            this.isLoaded = true;
            let aboutObj = data;
            res(aboutObj);
            }, (error) => {
                isLoaded = true;
                rej(error);
        });
    })
}

/* GET about */

/**
 * Fetch all required about information from database
 * @returns promise, when resolved returns aboutObj;
 */
function getSingularAbout() {
    return new Promise ((res, rej) => {
        let aboutObj = [];
        let aboutPromise = fetchCtrl([fetchSingleAbout()]);
        aboutPromise.then((data) => {
            aboutObj = data[0].data[0];
            res(aboutObj);
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
 * resolves fetch request for abouts
 * @returns promise, that is resolved on the completion of the fetch request
 */
function fetchSingleAbout ()  {
    return Promise.resolve(fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/about/read.php`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data;
    }).catch((error) => { console.error(error);}))   
}

