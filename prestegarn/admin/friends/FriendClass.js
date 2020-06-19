class FriendClass {
    constructor(friendObj) {
        this.friendObj = friendObj;
        this.isLoaded = false;
        this.newEvent = false;
        this.form = document.getElementById('friendForm');
    }
    /**
     * go through object and show information in all fields of the form
     * @param {object} friendObj object with friend information 
     */
    updateForm() {
        var {
            friendObj,
            form
        } = this;
        console.log(friendObj);
        form.elements.name.value = friendObj.name;
        form.elements.description.value = friendObj.description;
        form.elements.contact_name.value = friendObj.contact_name;
        form.elements.contact_phone.value = friendObj.contact_phone;
        form.elements.email.value = friendObj.email;
        form.elements.facebookLink.value = friendObj.facebookLink;
        form.elements.instagramLink.value = friendObj.instagramLink;
        form.elements.picture_url.value = friendObj.picture_url;
        form.elements.picture_alt.value = friendObj.picture_alt;
    }
}