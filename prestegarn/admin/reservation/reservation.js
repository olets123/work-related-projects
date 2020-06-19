
var isLoaded = false;
var reservationObj = [];
var dispError = null;
var table = document.getElementById('content');

var fetchPromise = Promise.resolve(fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/reservation/read.php`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))

fetchPromise.then((data) => {
    isLoaded= true;
    reservationObj = data;
    console.log(reservationObj);
    reservationObj.forEach((obj) => {
        table.innerHTML += `<tr><td>${obj.reservationId}</td><td>${obj.name}</td><td>${obj.email}</td><td>${obj.eventType}</td><td>${obj.mobile}</td><td>${obj.quantity}</td><td>${obj.fromDate}</td><td>${obj.toDate}</td><td>${obj.accepted}</td><td><a class="tableBtn" href='reservation.php?id=${obj.reservationId}'>endre</a></td><td><a class="tableBtn" href='reservation.php?delete=${obj.reservationId}'>slett</a></td></tr>`;
    })
},(error) => {
    isLoaded= true;
    dispError = error;
});
