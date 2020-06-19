/**
 * when all fetch requests are resolved put data gotten into their respected input fields, etc. 
 * @param id defined in events.php from url
*/
function defineObjects(idToGet) {
    return new Promise((res, rej) => {
        getSingularEvent(idToGet).then((data) => {
            this.isLoaded = true;
            let eventObj = data[0];
            let friendObj = data[1];
            let tagObj = data[2];
            console.log(tagObj);
            // remove tags already part of the event so that only the ones that are not part of the eventobject can show up in dropdown
            tagObjToSplice = tagObj.slice();
            for (let o = 0; o < tagObj.length; o++) {
                console.log(o);
                eventObj.tags.forEach(t => {
                    console.log(tagObj[o].tagId + ' ' + t.tagId);
                    if (tagObj[o].tagId === t.tagId) {
                        tagObjToSplice.splice(o, 1);
                    }
                })
            }
            tagObj = tagObjToSplice;
            // remove friends already part of the event so that only the ones that are not part of the eventobject can show up in dropdown
            friendObjToSplice = friendObj.slice();
            for (let j = 0; j < friendObj.length; j++) {
                eventObj.friends.forEach(f => {
                    if (friendObj[j].friendId === f.friendId) {
                        friendObjToSplice.splice(j, 1);
                    }
                })
            }
            friendObj = friendObjToSplice;
            res([eventObj, friendObj, tagObj]);
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
 * @returns promise, when resolved returns three objects (eventObj, friendObj, and tagObj);
 */
function getSingularEvent (id) {
    return new Promise ((res, rej) => {
        let eventObj = [];
        let friendIdObj = [];
        let tagObj = [];
        let friendObj = [];
        let programObj = [];
        let allTags = [];
        let eventPromise = fetchCtrl([fetchSingleEvent(id), fetchSingleFriendPartOfEvent(id), 
                fetchSingleEventHasTag(id, null), fetchFriends(), fetchSingleProgram(id, null), fetchTags()]);
        eventPromise.then((data) => {
            eventObj = data[0];
            friendIdObj = data[1].slice();
            tagObj = data[2].slice();
            friendObj = data[3].slice();
            programObj = data[4].slice();
            allTags = data[5].slice();

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

            res([eventObj, friendObj, allTags]);
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
 * resolves fetch request for events
 * @param {int} id of event to fetch
 * @returns promise, that is resolved on the completion of the fetch request
 */
function fetchSingleEvent (id)  {
    return Promise.resolve(fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/event/read_single.php?id=${id}`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data;
    }).catch((error) => { console.error(error);}))   
}

/**
 * resolves fetch request for "event has tags"
 * @param {int} eId id of event that has tags
 * @param {int} tId id of tag to fetch
 * @returns promise, that is resolved on the completion of the fetch request
 */
function fetchSingleEventHasTag (eId = null, tId = null)  {
    let fetchUrl = `${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/eventHasTags/read_single.php?tId=1&eId=1`;
    if (eId != null && tId != null) fetchUrl = `${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/eventHasTags/read_single.php?eId=${eId}&tId=${tId}`;
    else if (eId == null && tId != null) fetchUrl = `${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/eventHasTags/read_single.php?tId=${tId}`;
    else if (eId != null && tId == null) fetchUrl = `${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/eventHasTags/read_single.php?eId=${eId}`;
    return Promise.resolve(fetch(fetchUrl)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}

/**
 * resolves fetch request for "friends part of event"
 * @param {int} eId id of event to get friends from
 * @param {int} fId id of friend to fetch
 * @returns promise, that is resolved on the completion of the fetch request
 */
function fetchSingleFriendPartOfEvent (eId = null, fId = null)  {
    let fetchUrl = `${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/partof/read_single.php?fId=1&eId=1`;
    if (eId != null && fId != null) fetchUrl = `${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/partof/read_single.php?eId=${eId}&fId=${fId}`;
    else if (eId == null && fId != null) fetchUrl = `${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/partof/read_single.php?fId=${fId}`;
    else if (eId != null && fId == null) fetchUrl = `${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/partof/read_single.php?eId=${eId}`;
    return Promise.resolve(fetch(fetchUrl)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}

/**
 * resolves fetch request for event program
 * @param {int} eId id of event to get program info about. 
 * @param {int} pId id of program to fetch
 * @returns promise, that is resolved on the completion of the fetch request
 */
function fetchSingleProgram (eId = null, pId = null)  {
    let fetchUrl = `${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/program/read_single.php?eId=1&pId=1`;
    if (pId != null && eId != null) fetchUrl = `${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/program/read_single.php?pId=${pId}&eId=${eId}`;
    else if (pId == null && eId != null) fetchUrl = `${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/program/read_single.php?eId=${eId}`;
    else if (pId != null && eId == null) fetchUrl = `${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/program/read_single.php?pId=${pId}`;
    return Promise.resolve(fetch(fetchUrl)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}

/**
 * resolves fetch request for friends
 * @returns promise, that is resolved on the completion of the fetch request
 */
function fetchFriends ()  {
    return Promise.resolve(fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/friends/read.php`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}

/**
 * resolves fetch request for tags
 * @returns promise, that is resolved on the completion of the fetch request
 */
function fetchTags ()  {
    return Promise.resolve(fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/tags/read.php`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}