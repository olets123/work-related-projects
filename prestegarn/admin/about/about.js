
var isLoaded = false;
var aboutObj = [];
var dispError = null;
var table = document.getElementById('content');

var fetchPromise = Promise.resolve(fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/about/read.php`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))

fetchPromise.then((data) => {
    isLoaded= true;
    aboutObj = data;
    console.log(aboutObj);
    aboutObj.forEach((obj) => {
        table.innerHTML += `<tr><td>${obj.aboutId}</td><td>${obj.hansContent}</td><td>${obj.anitaContent}</td><td>${obj.mainContent}</td><td>${obj.anitaPicture_url}</td><td>${obj.anitaPicture_alt}</td><td>${obj.hansPicture_url}</td><td>${obj.hansPicture_alt}</td><td>${obj.mainPicture_url}</td><td>${obj.mainPicture_alt}</td><td><a class="tableBtn" href='about.php?id=${obj.aboutId}'>endre</a></td></tr>`;
    })
},(error) => {
    isLoaded= true;
    dispError = error;
});