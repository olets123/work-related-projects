
var isLoaded = false;
var userObj = [];
var dispError = null;
var table = document.getElementById('content');

var fetchPromise = Promise.resolve(fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/users/read.php`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))

fetchPromise.then((data) => {
    isLoaded= true;
    userObj= data;
    console.log(userObj);
    userObj.forEach((obj) => {
        table.innerHTML += `<tr><td>${obj.username}</td></tr>`;
    })
},(error) => {
    isLoaded= true;
    dispError = error;
});
