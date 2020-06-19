import { fetchCtrl } from './apiHandlers/fetchCtrl.js';
import { fetchHistory, fetchGallery } from './apiHandlers/fetchAll.js';

/**
 * Create object with all history elements
 * @returns promise with the history objects
*/
export const getDisplayHistory = () => {
    return new Promise ((res, rej) => {
        let historyObj = [];
        let galleryObj = [];
        let historyPromise = fetchCtrl([fetchHistory(), fetchGallery()]);
        historyPromise.then((data) => {
            historyObj = data[0].slice();
            galleryObj = data[1].slice();
            historyObj.forEach((obj) => {
                obj.pictures = galleryObj.filter(pic => pic.timeId === obj.timeId);
            });
            res(historyObj);
        }).catch(error => { rej(() => { throw new Error(error)})});
    })
}