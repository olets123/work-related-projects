import { fetchCtrl } from './apiHandlers/fetchCtrl.js';
import { eventSearch, tagSearch, historySearch } from './apiHandlers/fetchSearch.js';
import { fetchEvents, fetchFriendsPartOfEvents, fetchEventHasTags, fetchGallery } from './apiHandlers/fetchAll.js';

/**
 * Search all events with the search parameter
 * @param {string} search user inputed search parameter
 * @returns promise with event information
*/
export const getSearchEvents = (search) => {
    return new Promise ((res, rej) => {
        if (search.length > 2) {
        let eventObj = [];
        let tagEventObj = [];
        let friendObj = [];
        let tagObj = [];
        let eventPromise = fetchCtrl([eventSearch(search), fetchFriendsPartOfEvents(), fetchEventHasTags(), tagSearch(search), fetchEvents()]);
        eventPromise.then((data) => {
            if (data[3] === undefined && data[0] === undefined) {
                rej(console.error('found no events'));
            } else if ((data[3] === undefined && data[0] !== undefined) || (data[3] !== undefined && data[0] !== undefined)) {
                eventObj = data[0].slice();
                friendObj = data[1].slice();
                tagEventObj = data[2].slice();              
                eventObj.forEach((obj) => {
                    obj.friend_ids = friendObj.filter(friend => friend.eventId === obj.eventId);
                    obj.tags = tagEventObj.filter(tag => tag.eventId === obj.eventId);
                    let hashtag = obj.title;
                    let year = obj.date.slice(0, 4);
                    hashtag = hashtag.split(' ').join('');
                    hashtag = '#' + hashtag + '' + year;
                    obj.hashtag = hashtag;
                });
                res(eventObj);
            } else if (data[3] !== undefined && data[0] === undefined) {
                friendObj = data[1].slice();
                tagEventObj = data[2].slice();
                tagObj = data[3].slice();
                tagObj.forEach((tags) => {
                    tags.friend_ids = friendObj.filter(friend => friend.eventId === tags.eventId);
                    tags.tags = tagEventObj.filter(tag => tag.eventId === tags.eventId);
                    let hashtag = tags.title;
                    let year = tags.date.slice(0, 4);
                    hashtag = hashtag.split(' ').join('');
                    hashtag = '#' + hashtag + '' + year;
                    tags.hashtag = hashtag;
                })
                res(tagObj);
            }
        }).catch(error => { rej({'message': error.message })});
        } else {
            rej({'message': 'search must be longer than 2 characters'});
        }
    })
}

/**
 * Search all history with the search parameter
 * @param {string} search user inputed search parameter
 * @returns promise with history information
*/
export const getSearchHistory = (search) => {
    let s = search.toString();
    return new Promise ((res, rej) => {
        if (s.length > 2) {
        let historyObj = [];
        let galleryObj = [];
        let historyPromise = fetchCtrl([historySearch(s), fetchGallery()]);
        historyPromise.then((data) => {
            historyObj = data[0].slice();
            galleryObj = data[1].slice();
            historyObj.forEach((obj) => {
                obj.pictures = galleryObj.filter(pic => pic.timeId === obj.timeId);
            });
            res(historyObj);
        }).catch(error => { rej(() => { throw new Error(error)})});
        } else {
            rej({'message': 'search must be longer than 2 characters'})
        }
    })
}