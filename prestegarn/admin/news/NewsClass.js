class NewsClass {
    constructor(newsObj) {
        this.newsObj = newsObj;
        this.isLoaded = false;
        this.form = document.getElementById('newsForm');
    }
    
    /**
     * go through objects and show information in all fields of the form
     * @param {object} newsObj object with event information 
     */
    updateForm() {
        var {
            newsObj,
            form
        } = this;
        form.elements.content.value = newsObj.content;
    }
}