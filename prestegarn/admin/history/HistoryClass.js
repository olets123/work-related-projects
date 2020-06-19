class HistoryClass {
    constructor(historyObj) {
        this.historyObj = historyObj;
        this.isLoaded = false;
        this.newHistory = false;
        this.form = document.getElementById('historyForm');
    }
    
    /**
     * go through objects and array of objects and show information in all fields of the form
     * @param {object} historyObj object with history information 
     */
    updateForm(all = true) {
        var {
            historyObj,
            form
        } = this;
        if (all === true) {
            form.elements.year.value = historyObj.year;
            form.elements.title.value = historyObj.title;
            form.elements.description.value = historyObj.description;
        }
        
        form.elements.gallery.innerHTML = '';
        historyObj.pictures.forEach(gallery => {
            let galleryDiv = document.createElement("div");
            galleryDiv.innerHTML += `<input type="text" placeholder="bildelink" value="${gallery.picture_url}"/><input type="text" placeholder="bilde beskrivelse" value="${gallery.picture_alt}"/><input type="text" placeholder="bilde opphavsrett" value="${gallery.copyright}"/><button type="button" id="removeGallery" class="remove">-</button>`;
            galleryDiv.id = gallery.galleryId;
            form.elements.gallery.appendChild(galleryDiv);
        })
        form.elements.gallery.innerHTML +=  `<div><input type="text" placeholder="bildelink"/><input type="text" placeholder="bilde beskrivelse"/><input type="text" placeholder="bilde opphavsrett"/><button type="button" id="addGallery" class="add">+</button></div></div>`;
        
        document.getElementById('addGallery').addEventListener('click', () => { this.createGallery(event); });  
        
        let removeGallery = document.querySelectorAll('#removeGallery.remove');
        removeGallery.forEach((btn) => {
            btn.addEventListener('click', () => { this.removeGallery(event); });
        })
    }

    /**
     * when create gallery button is clicked create new gallery and send it to the database
     * also add the new gallery to the historyObject
     * @param {event} e 
    */
   createGallery(e) {
        let galleryDiv = e.target.parentNode.children;
        console.log(galleryDiv);
        let picture_url = galleryDiv[0].value;
        let picture_alt = galleryDiv[1].value;
        if (this.newHistory === false) {
            if (picture_url.length >= 4 && picture_alt.length >= 4) {
                let body = JSON.stringify({
                    timeId: this.historyObj.timeId,
                    picture_url: picture_url,
                    picture_alt: picture_alt,
                    copyright: copyright
                });
                fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/gallery/create.php`, {
                    method: 'POST',
                    body: body
                }).then((data) => {
                    if (data.statusText == 'OK') {
                        fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/gallery/search.php?search=${picture_url}`, {
                            method: 'GET'
                        }).then((data => data.json())).then((data) => {
                            let galleryId = data.data[0].galleryId;
                            this.historyObj.pictures.push({ galleryId: galleryId, timeId: this.historyObj.timeId, picture_url: picture_url, picture_alt: picture_alt, copyright: copyright });
                            this.updateForm(false);
                        })
                    }
                }).catch((err) => { console.error(err); });
            }
        } else {
            var i = Math.random(0, 10000);
            if (picture_url.length >= 4 && picture_alt.length >= 4) {
                this.historyObj.pictures.push({ galleryId: i, timeId: 'temp', picture_url: picture_url, picture_alt: picture_alt, copyright: copyright });
                this.updateForm(false);
            }
        }
    }

    /**
     * when remove Gallery button is clicked, remove the Gallery from the historyObject and update the form
     * @param {event} e 
     */
    removeGallery(e) {
        let galleryId = e.target.parentNode.id;
        if (this.newHistory === false) {
            console.log(galleryId);
            if (galleryId != null) {
                fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/gallery/delete.php?id=${galleryId}`, {
                    method: 'DELETE'
                }).then((data) => { 
                    console.log(data.statusText);
                    this.historyObj.pictures.forEach((gallery, i) => {
                        if (gallery.galleryId === galleryId) {
                            this.historyObj.pictures.splice(i, 1);
                        }
                    })
                    this.updateForm(false);
                }).catch((err) => { console.error(err); });
            } 
        } else {
            console.log(this.historyObj);
            this.historyObj.pictures.forEach((gallery, i) => {
                if (gallery.galleryId == galleryId) {
                    this.historyObj.pictures.splice(i, 1);
                }
            })
            this.updateForm(false);
        }
    }
}