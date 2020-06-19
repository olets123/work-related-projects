
var isLoaded = false;
var tagObj = [];
var dispError = null;
var table = document.getElementById('content');

var fetchPromise = Promise.resolve(fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/tags/read.php`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))

fetchPromise.then((data) => {
    isLoaded= true;
    tagObj= data;
    tagObj.forEach((obj) => {
        table.innerHTML += `<tr><td>${obj.tagId}</td><td>${obj.content}</td>
        <td><a class="tableBtn" href='tags.php?id=${obj.tagId}'>endre</a></td>
        <td><a class="tableBtn" href='tags.php?delete=${obj.tagId}'>slett</a></td></tr>`;
    })
},(error) => {
    isLoaded= true;
    dispError = error;
});
