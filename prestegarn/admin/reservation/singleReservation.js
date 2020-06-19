/**
 * when all fetch requests are resolved create class. 
 * @param idToGet defined in reservation.php from url
*/
function defineObjects(idToGet) {
    return new Promise((res, rej) => {
        getSingularReservation(idToGet).then((data) => {
            this.isLoaded = true;
            let reservationObj = data;
            res(reservationObj);
            }, (error) => {
                isLoaded = true;
                rej(error);
        });
    })
}

/* GET reservation */

/**
 * Fetch all required reservation information from database
 * @param {int} id get reservation with this id
 * @returns promise, when resolved returns reservationObj;
 */
function getSingularReservation(id) {
    return new Promise ((res, rej) => {
        let reservationObj = [];
        let resPromise = fetchCtrl([fetchSingleReservation(id)]);
        resPromise.then((data) => {
            reservationObj = data[0];
            res(reservationObj);
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
 * resolves fetch request for reservations
 * @param {int} id of reservation to fetch
 * @returns promise, that is resolved on the completion of the fetch request
 */
function fetchSingleReservation (id)  {
    return Promise.resolve(fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/reservation/read_single.php?id=${id}`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data;
    }).catch((error) => { console.error(error);}))   
}