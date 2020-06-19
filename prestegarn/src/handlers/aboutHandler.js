import { fetchCtrl } from './apiHandlers/fetchCtrl.js';
import { fetchAbout } from './apiHandlers/fetchAll.js';

/**
 * Create object with fetched "about" information
*/
export const getDisplayAbout = () => {
    return new Promise ((res, rej) => {
        let aboutObj = [];
        let aboutPromise = fetchCtrl([fetchAbout()]);
        aboutPromise.then((data) => {
            aboutObj = data[0].slice();
            res(aboutObj);
        }).catch(error => { rej(() => { throw new Error(error)})});
    })
}