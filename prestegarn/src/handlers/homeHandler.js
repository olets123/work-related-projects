import { fetchCtrl } from './apiHandlers/fetchCtrl.js';
import { fetchEvents, fetchHistory, fetchGallery } from './apiHandlers/fetchAll.js';

/**
 * get information for the homepage, event and history
 * @returns promise with eventObject and historyObject
*/
export const getExplore = () => {
    return new Promise ((res, rej) => {
        let eventObj = [];
        let historyObj = [];
        let galleryObj = [];
        let explorePromise = fetchCtrl([fetchEvents(1, 1), fetchHistory(1), fetchGallery()]);
        explorePromise.then((data) => {
            eventObj = data[0].slice();
            historyObj = data[1].slice();
            galleryObj = data[2].slice();
            historyObj.forEach((obj) => {
                obj.pictures = galleryObj.filter(pic => pic.timeId === obj.timeId);
            });
            res([eventObj, historyObj]);
        }).catch(error => { rej(() => { throw new Error(error)})});
    })
}