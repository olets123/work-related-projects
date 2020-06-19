class TagClass {
    constructor(tagObj) {
        this.tagObj = tagObj;
        this.isLoaded = false;
        this.form = document.getElementById('tagForm');
    }
    
    /**
     * go through objects and show information in all fields of the form
     * @param {object} tagObj object with event information 
     */
    updateForm() {
        var {
            tagObj,
            form
        } = this;
        form.elements.content.value = tagObj.content;
    }
}