/**
 * run when about form is submitted, makes a PUT fetch to update the about in the database
 * @param {event} e on submit event
 * @param {html} form form with all about data
 */
function handleFormUpdate(e, form) {
    e.preventDefault();
    let updateResObj = {
        reservationId: `${id}`,
        accepted: form.accepted.checked
    };
    let resPromise = sendReservationObj(updateResObj);
    resPromise.then(data => console.log(data));   // show message on page somehow...
   
}
