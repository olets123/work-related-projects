
/**
 * makes fetch of type PUT to update event table in the database through the API
 * @param {object} obj data to be changed
 */
function sendHistoryObj(obj) {
    obj = JSON.stringify(obj);
    return new Promise((res, rej) => {
        fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/history/update.php`, {
            method: 'PUT',
            body: obj
        }).then(data => {
            res([true, data.statusText]);
        }).catch(err => {
            rej([false, err]);
        })
    })
}
function sendGallery(arr) {
    arr.forEach(gallery => {
        let body = JSON.stringify({
            timeId: id,
            galleryId: gallery.galleryId,
            picture_url: gallery.picture_url,
            picture_alt: gallery.picture_alt,
            copyright: gallery.copyright
        });
        console.log(body);
        fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/gallery/update.php`, {
            method: 'PUT',
            body: body
        }).then((data) => {
            console.log(data.statusText);
        })
    });
}