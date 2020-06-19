
var isLoaded = false;
var eventObj = [];
var dispError = null;

function getNewObj () {
    return new Promise ((res, rej) => {
        let eventObj = [];
        let tagObj = [];
        let friendObj = [];
        let eventPromise = fetchCtrl([fetchTags(), fetchFriends()]);
        eventPromise.then((data) => {
            eventObj = { eventId: '', title: '', description: '', date: '', ticketsSold: '', numTickets: '', price: '', picture_url: '', picture_alt: '', tags: [], friends: [], program: []};
            friendObj = data[0].slice();
            tagObj = data[1].slice();
            res([eventObj, friendObj, tagObj]);
        }).catch(error => { rej(() => { throw new Error(error)})});
    })
}

function fetchCtrl (promises) {
    return new Promise ((res, rej) => {
        Promise.all(promises).then((data) => { res(data)}).catch((error) => { rej(() => { throw new Error(error); })})
    })
}

function fetchTags() {
    return Promise.resolve(fetch(`http://127.0.0.1/2019-IMT2671-GF/app/prestegarn/back-end/api/tags/read.php`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}

function fetchFriends() {
    return Promise.resolve(fetch(`http://127.0.0.1/2019-IMT2671-GF/app/prestegarn/back-end/api/friends/read.php`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}