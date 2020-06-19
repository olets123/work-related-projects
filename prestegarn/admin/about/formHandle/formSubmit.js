/**
 * run when about form is submitted, makes a PUT fetch to update the about in the database
 * @param {event} e on submit event
 * @param {html} form form with all about data
 */
function handleFormUpdate(e, form) {
    e.preventDefault();
    let error = validateForm(form);
    if (error[0] === true) { console.log(error) 
    } else {
        let updateAboutObj = {
            aboutId: `${id}`,
            hansContent: form.hansContent.value,
            anitaContent: form.anitaContent.value,
            mainContent: form.mainContent.value,
            anitaPicture_url: form.anitaPicture_url.value,
            anitaPicture_alt: form.anitaPicture_alt.value,
            hansPicture_url: form.hansPicture_url.value,
            hansPicture_alt: form.hansPicture_alt.value,
            mainPicture_url: form.mainPicture_url.value,
            mainPicture_alt: form.mainPicture_alt.value
        };
        console.log(updateAboutObj);
         let aboutPromise = sendAboutObj(updateAboutObj);
        aboutPromise.then(data => console.log(data));   
    }
}
