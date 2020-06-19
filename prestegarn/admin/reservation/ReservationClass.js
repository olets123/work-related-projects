class ReservationClass {
    constructor(reservationObj) {
        this.reservationObj = reservationObj;
        this.isLoaded = false;
        this.content = document.getElementById('reservationContent').children;
        this.form = document.getElementById('reservationForm');
    }
    
    /**
     * go through objects and show information in all fields of the form
     * @param {object} reservation object with event information 
     */
    updateForm() {
        var {
            reservationObj,
            form,
            content
        } = this;
        content.name.innerHTML += reservationObj.name;
        content.email.innerHTML += reservationObj.email;
        content.eventType.innerHTML += reservationObj.eventType;
        content.mobile.innerHTML += reservationObj.mobile;
        content.quantity.innerHTML += reservationObj.quantity;
        content.fromDate.innerHTML += reservationObj.fromDate;
        content.toDate.innerHTML += reservationObj.toDate;
        form.elements.accepted.checked = !!+reservationObj.accepted;
    }
}