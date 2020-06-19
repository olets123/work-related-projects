
/**
 * makes fetch of type POST to create an event table in the database through the API
 * @param {object} obj eventObj to be created
 */
function createHistory(obj) {
    jsonObj = JSON.stringify(obj);
    return new Promise((res, rej) => {
        fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/history/create.php`, {
            method: 'POST',
            body: jsonObj
        }).then(data => {
            let search = obj.year;
            if (data.statusText == 'OK') {
                fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/history/search.php?search=${search}&admin=1`,{
                    method: 'GET'
                })
                .then(data => data.json()).then((data) => {
                    let timeId = data.data[0].timeId;
                    res([true, timeId]);
                }).catch(err => console.error(err));
            }
        }).catch(err => {
            rej([false, err]);
        })
    })
}
function createGallery(arr, timeId) {
    arr.forEach(gallery => {
        let body = JSON.stringify({
            timeId: timeId,
            picture_url: gallery.picture_url,
            picture_alt: gallery.picture_alt,
            copyright: gallery.copyright
        });
        console.log(body);
        fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/gallery/create.php`, {
            method: 'POST',
            body: body
        }).then((data) => {
            console.log(data.statusText);
        })
    });
}
