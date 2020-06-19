
var isLoaded = false;
var historyObj = [];
var dispError = null;
var table = document.getElementById('content');

getDisplayHistory().then((data) => {
    isLoaded= true;
    historyObj= data;
    historyObj.forEach((obj) => {
        let pictureArr = [];
        let pictureArrAlt = [];
        let pictureArrCopyright = [];
        obj.pictures.forEach(pic => {
            pictureArr.push(pic.picture_url);
            pictureArrAlt.push(pic.picture_alt);
            pictureArrCopyright.push(pic.copyright);
        })
        table.innerHTML += `<tr><td>${obj.timeId}</td>
            <td>${obj.year}</td><td>${obj.title}</td><td>${obj.description}</td>
            <td>${pictureArr}</td><td>${pictureArrAlt}</td><td>${pictureArrCopyright}</td>
            <td><a class="tableBtn" href='history.php?id=${obj.timeId}'>endre</a></td>
            <td><a class="tableBtn" href='history.php?delete=${obj.timeId}'>slett</a></td></tr>`;
    })
},(error) => {
    isLoaded= true;
    dispError = error;
});

function getDisplayHistory () {
    return new Promise ((res, rej) => {
        let historyObj = [];
        let galleryObj = [];
        let historyPromise = fetchCtrl([fetchHistory(), fetchGallery()]);
        historyPromise.then((data) => {
            historyObj = data[0].slice();
            galleryObj = data[1].slice();
            historyObj.forEach((obj) => {
                obj.pictures = galleryObj.filter(pic => pic.timeId === obj.timeId);
            });
            res(historyObj);
        }).catch(error => { rej(() => { throw new Error(error)})});
    })
}

function fetchCtrl (promises) {
    return new Promise ((res, rej) => {
        Promise.all(promises).then((data) => { res(data)}).catch((error) => { rej(() => { throw new Error(error); })})
    })
}

function fetchHistory () {
    return Promise.resolve(fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/history/read.php`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}

function fetchGallery () {
    return Promise.resolve(fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/gallery/read.php`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}