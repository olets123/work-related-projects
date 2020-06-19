import { fetchCtrl } from './apiHandlers/fetchCtrl.js';
import { fetchEvents, fetchFriendsPartOfEvents, fetchEventHasTags, fetchFriends, fetchTags } from './apiHandlers/fetchAll.js';
import { fetchSingleEvent, fetchSingleFriendPartOfEvent, fetchSingleEventHasTag, fetchSingleProgram } from './apiHandlers/fetchSingle.js';
import { parseableDate } from '../components/functions/parseDate.js';

/**
 * Create eventObj with all information about that event
 * @param {integer} limit => limiting the events to get
 * @returns promise with eventObject, pastEventObject, and tags
*/
export const getDisplayEvents = (limit = null) => {
    return new Promise ((res, rej) => {
        let eventObj = [];
        let tagObj = [];
        let friendObj = [];
        let displayTags = [];
        let eventPromise = fetchCtrl([fetchEvents(limit), fetchFriendsPartOfEvents(), fetchEventHasTags(), fetchTags()]);
        eventPromise.then((data) => {
            eventObj = data[0].slice();
            friendObj = data[1].slice();
            tagObj = data[2].slice();
            displayTags = data[3].slice();
            eventObj.forEach((obj) => {
                obj.friend_ids = friendObj.filter(friend => friend.eventId === obj.eventId);
                obj.tags = tagObj.filter(tag => tag.eventId === obj.eventId);
                let hashtag = obj.title;
                let year = obj.date.slice(0, 4);
                hashtag = hashtag.split(' ').join('');
                hashtag = '#' + hashtag + '' + year;
                obj.hashtag = hashtag;
            });
            let pastEventObj = getPastEvents(eventObj);
            res([eventObj, pastEventObj, displayTags]);
        }).catch(error => { rej(() => { throw new Error(error)})});
    })
}

/**
 * Create object for the one event fetched
 * @param {integer} id of event to get
 * @returns promise with eventObject
*/
export const getSingularEvent = (id) => {
    return new Promise ((res, rej) => {
        let eventObj = [];
        let friendIdObj = [];
        let tagObj = [];
        let friendObj = [];
        let programObj = [];
        let eventPromise = fetchCtrl([fetchSingleEvent(id), fetchSingleFriendPartOfEvent(id), fetchSingleEventHasTag(id, null), fetchFriends(), fetchSingleProgram(id, null)]);
        eventPromise.then((data) => {
            eventObj = data[0];
            friendIdObj = data[1].slice();
            tagObj = data[2].slice();
            friendObj = data[3].slice();
            programObj = data[4].slice();

            eventObj.friends = [];
            eventObj.tags = [];
            eventObj.program = [];

            let newFriendArr = friendIdObj.map(f => { return f.friendId });
            eventObj.friends = friendObj.filter((friend) => newFriendArr.includes(friend.friendId));
            eventObj.tags = tagObj.filter(tag => tag.eventId === eventObj.eventId); 
            eventObj.program = programObj.filter(prog => prog.eventId === eventObj.eventId); 

            let hashtag = eventObj.title;
            let year = eventObj.date.slice(0, 4);
            hashtag = hashtag.split(' ').join('');
            hashtag = '#' + hashtag + '' + year;
            eventObj.hashtag = hashtag;

            res(eventObj);
        }).catch(error => { rej(() => { throw new Error(error)})});
    })
}

/**
 * Get current date
 * @returns today's date 
*/
function getDate() {
    var today = new Date();
    today = Date.parse(today);
    return today;
}

/**
 * Filter out the events that are in the future
 * @param {object} obj 
 * @returns object with all past events
*/
function getPastEvents (obj) {
    let date = getDate();
    var pastEventObj = obj.filter((event) => {
        let eventDate =  Date.parse(parseableDate(event.date));
        return (eventDate <= date);
    });
    return pastEventObj;
}
