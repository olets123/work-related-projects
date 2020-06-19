/**
 * run when event form is submitted, makes a PUT fetch to update the event in the database
 * @param {event} e on submit event
 * @param {html} form form with all event data
 */
function handleFormUpdate(e, form) {
    e.preventDefault();
    const gallery = getGalleryArr(form.gallery.childNodes);
    let error = validateForm(form, gallery);
    if (error[0] === true) { console.log(error) 
    } else {
        let updateHistoryObj = [{
            timeId: `${id}`,
            year: form.year.value,
            title: form.title.value,
            description: form.description.value
        }, gallery ]
        console.log(updateHistoryObj);
        let historyPromise = sendHistoryObj(updateHistoryObj[0]);
        historyPromise.then(data => console.log(data));   // show message on page somehow...
        sendGallery(updateHistoryObj[1]);
    }
}

function handleFormCreate(e, form) {
    e.preventDefault();
    let tId = 0;
    const gallery = getGalleryArr(form.gallery.childNodes);
    let error = validateForm(form, gallery);
    if (error[0] === true) { console.log(error) 
    } else {
        let updateHistoryObj = [{
            year: form.year.value,
            title: form.title.value,
            description: form.description.value
        }, gallery ]

        let historyPromise = createHistory(updateHistoryObj[0]);
        historyPromise.then(data => {
            tId = data[1];
            createGallery(updateHistoryObj[1], tId);
        });
    }
}

/**
 * creates array of objects from html input fields
 * @param {html} gallery collection of gallery input fields
 * @returns array of objects with all necessary gallery information
 */
function getGalleryArr(gallery) {
    const galleryArr = [];
    for (let i = 0; i < gallery.length; i++) {
        let galDiv = gallery[i].childNodes;
        if(galDiv[3].attributes.class.nodeValue != 'add') {
            galleryArr.push({ galleryId: gallery[i].id, picture_url: galDiv[0].value, picture_alt: galDiv[1].value, copyright: galDiv[2].value });
        }
    }

    return galleryArr;
}
