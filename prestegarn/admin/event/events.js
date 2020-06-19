
var isLoaded = false;
var eventObj = [];
var dispError = null;
var table = document.getElementById('content');

getDisplayEvents().then((data) => {
    isLoaded= true;
    eventObj= data;
    console.log(eventObj);
    eventObj.forEach((obj) => {
        let tagArr = [];
        obj.tags.forEach(tag => {
            tagArr.push(tag.tagContent);
        })
        let friendArr = [];
        obj.friend_ids.forEach(friend => {
            friendArr.push(friend.friendName);
        })
        table.innerHTML += `<tr><td>${obj.eventId}</td>
            <td>${obj.title}</td><td>${obj.description}</td><td>${obj.date}</td>
            <td>${obj.numTickets}</td><td>${obj.ticketsSold}</td><td>${obj.price}</td>
            <td>${obj.picture_url}</td><td>${obj.picture_alt}</td><td>${tagArr}</td>
            <td>${friendArr}</td><td><a class="tableBtn" href='events.php?id=${obj.eventId}'>endre</a></td>
            <td><a class="tableBtn" href='events.php?delete=${obj.eventId}'>slett</a></td></tr>`;
    })
},(error) => {
    isLoaded= true;
    dispError = error;
});

/* GET EVENT */
function getDisplayEvents () {
    return new Promise ((res, rej) => {
        let eventObj = [];
        let tagObj = [];
        let friendObj = [];
        let eventPromise = fetchCtrl([fetchEvents(), fetchFriendsPartOfEvents(), fetchEventHasTags(), fetchTags()]);
        eventPromise.then((data) => {
            eventObj = data[0].slice();
            friendObj = data[1].slice();
            tagObj = data[2].slice();
            displayTags = data[3].slice();
            eventObj.forEach((obj) => {
                obj.friend_ids = friendObj.filter(friend => friend.eventId === obj.eventId);
                obj.tags = tagObj.filter(tag => tag.eventId === obj.eventId);
            });
            res(eventObj);
        }).catch(error => { rej(() => { throw new Error(error)})});
    })
}

function fetchCtrl (promises) {
    return new Promise ((res, rej) => {
        Promise.all(promises).then((data) => { res(data)}).catch((error) => { rej(() => { throw new Error(error); })})
    })
}
function fetchEvents() {
    return Promise.resolve(fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/event/read.php`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}

function fetchFriendsPartOfEvents() {
    return Promise.resolve(fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/partof/read.php`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}

function fetchEventHasTags() {
    return Promise.resolve(fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/eventHasTags/read.php`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}

function fetchTags() {
    return Promise.resolve(fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/tags/read.php`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}