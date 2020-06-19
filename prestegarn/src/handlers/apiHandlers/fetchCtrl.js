let hostname = window.location.hostname;
let location = window.location.protocol;
let tempHost = '';
if (hostname === 'localhost') {
    tempHost = `${location}//${hostname}:8080/2019-IMT2671-GF/app/prestegarn/back-end/api`;
} else {
    tempHost = `${location}//${hostname}/back-end/api`
}
export const host = tempHost;

/**
 * Function to control array of promises
 * @param {array} promises array of promises to be run
 * @returns promise
*/
export const fetchCtrl = (promises) => {
    return new Promise ((res, rej) => {
        Promise.all(promises).then((data) => { res(data)}).catch((error) => { rej(() => { throw new Error(error); })})
    })
}