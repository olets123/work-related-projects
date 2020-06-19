
var isLoaded = false;
var friendObj = [];
var dispError = null;
var table = document.getElementById('content');

var fetchPromise = Promise.resolve(fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/friends/read.php`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))

fetchPromise.then((data) => {
    isLoaded= true;
    friendObj= data;
    console.log(friendObj);
    friendObj.forEach((obj) => {
        table.innerHTML += `<tr><td>${obj.friendId}</td>
            <td>${obj.name}</td><td>${obj.description}</td><td>${obj.contact_name}</td>
            <td>${obj.contact_phone}</td><td>${obj.email}</td><td>${obj.facebookLink}</td>
            <td>${obj.instagramLink}</td><td>${obj.picture_url}</td><td>${obj.picture_alt}</td>
            <td><a class="tableBtn" href='friends.php?id=${obj.friendId}'>endre</a></td>
            <td><a class="tableBtn" href='friends.php?delete=${obj.friendId}'>slett</a></td></tr>`;
    })
},(error) => {
    isLoaded= true;
    dispError = error;
});
