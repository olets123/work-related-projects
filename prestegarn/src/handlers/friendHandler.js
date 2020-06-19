import { fetchCtrl } from './apiHandlers/fetchCtrl.js';
import { fetchFriends } from './apiHandlers/fetchAll.js';

/**
 * Create friendObject with information fetched from all friends
 * @returns promise with friendObject
*/
export const getFriends = () => {
    return new Promise ((res, rej) => {
        let friendObj = [];
        let friendPromise = fetchCtrl([fetchFriends()]);
        friendPromise.then((data) => {
            friendObj = data[0].slice();
            res(friendObj);
        }).catch(error => { rej(() => { throw new Error(error)})});
    })
}