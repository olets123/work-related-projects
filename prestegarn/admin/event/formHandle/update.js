
/**
 * makes fetch of type PUT to update event table in the database through the API
 * @param {object} obj data to be changed
 */
function sendEventObj(obj) {
    obj = JSON.stringify(obj);
    return new Promise((res, rej) => {
        fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/event/update.php`, {
            method: 'PUT',
            body: obj
        }).then(data => {
            res([true, data.statusText]);
        }).catch(err => {
            rej([false, err]);
        })
    })
}
function sendProgram(arr) {
    arr.forEach(prog => {
        let body = JSON.stringify({
            eventId: id,
            programId: prog.programId,
            time: prog.time,
            content: prog.content
        });
        console.log(body);
        fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/program/update.php`, {
            method: 'PUT',
            body: body
        }).then((data) => {
            console.log(data.statusText);
        })
    });
}