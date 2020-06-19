
/**
 * makes fetch of type POST to create an event table in the database through the API
 * @param {object} obj eventObj to be created
 */
function createEvent(obj) {
    jsonObj = JSON.stringify(obj);
    return new Promise((res, rej) => {
        fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/event/create.php`, {
            method: 'POST',
            body: jsonObj
        }).then(data => {
            let search = obj.title;
            if (data.statusText == 'OK') {
                fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/event/search.php?search=${search}&admin=1`,{
                    method: 'GET'
                })
                .then(data => data.json()).then((data) => {
                    let eventId = data.data[0].eventId;
                    res([true, eventId]);
                }).catch(err => console.error(err));
            }
        }).catch(err => {
            rej([false, err]);
        })
    })
}
function createProgram(arr, eventId) {
    arr.forEach(prog => {
        let body = JSON.stringify({
            eventId: eventId,
            time: prog.time,
            content: prog.content
        });
        console.log(body);
        fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/program/create.php`, {
            method: 'POST',
            body: body
        }).then((data) => {
            console.log(data.statusText);
        })
    });
}

function createFriends(arr, eventId) {
    arr.forEach(friend => {
        let body = JSON.stringify({
            eventId: eventId,
            friendId: friend.friendId
        });
        console.log(body);
        fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/partof/create.php`, {
            method: 'POST',
            body: body
        }).then((data) => {
            console.log(data.statusText);
        })
    });
}

function createTags(arr, eventId) {
    arr.forEach(tag => {
        let body = JSON.stringify({
            eventId: eventId,
            tagId: tag.tagId
        });
        console.log(body);
        fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/eventHasTags/create.php`, {
            method: 'POST',
            body: body
        }).then((data) => {
            console.log(data.statusText);
        })
    });
}