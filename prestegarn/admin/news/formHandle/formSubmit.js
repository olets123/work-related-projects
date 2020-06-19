/**
 * run when news form is submitted, makes a PUT fetch to update the news in the database
 * @param {event} e on submit event
 * @param {html} form form with all news data
 */
function handleFormUpdate(e, form) {
    e.preventDefault();
    let error = validateForm(form);
    if (error[0] === true) { console.log(error) 
    } else {
        let updateNewsObj = {
            newsId: `${id}`,
            content: form.content.value
        };
        console.log(updateNewsObj);
         let newsPromise = sendNewsObj(updateNewsObj);
        newsPromise.then(data => console.log(data));   // show message on page somehow...
    }
}
