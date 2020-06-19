class AboutClass {
    constructor(aboutObj) {
        this.aboutObj = aboutObj;
        this.isLoaded = false;
        this.form = document.getElementById('aboutForm');
    }
    
    /**
     * go through objects and show information in all fields of the form
     * @param {object} aboutObj object with event information 
     */
    updateForm() {
        var {
            aboutObj,
            form
        } = this;
        form.elements.hansContent.value = aboutObj.hansContent;
        form.elements.anitaContent.value = aboutObj.anitaContent;
        form.elements.mainContent.value = aboutObj.mainContent;
        form.elements.anitaPicture_url.value = aboutObj.anitaPicture_url;
        form.elements.anitaPicture_alt.value = aboutObj.anitaPicture_alt;
        form.elements.hansPicture_url.value = aboutObj.hansPicture_url;
        form.elements.hansPicture_alt.value = aboutObj.hansPicture_alt;
        form.elements.mainPicture_url.value = aboutObj.mainPicture_url;
        form.elements.mainPicture_alt.value = aboutObj.mainPicture_alt;
    }
}