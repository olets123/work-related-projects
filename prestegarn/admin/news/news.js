
var isLoaded = false;
var newsObj = [];
var dispError = null;
var table = document.getElementById('content');

var fetchPromise = Promise.resolve(fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/news/read.php`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))

fetchPromise.then((data) => {
    isLoaded= true;
    newsObj= data;
    console.log(newsObj);
    newsObj.forEach((obj) => {
        table.innerHTML += `<tr><td>${obj.newsId}</td>
            <td>${obj.content}</td><td><a class="tableBtn" href='news.php?id=${obj.newsId}'>endre</a></td></tr>`;
    })
},(error) => {
    isLoaded= true;
    dispError = error;
});

/* function fetchCtrl (promises) {
    return new Promise ((res, rej) => {
        Promise.all(promises).then((data) => { res(data)}).catch((error) => { rej(() => { throw new Error(error); })})
    })
} */