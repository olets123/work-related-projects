/**
 * validates the form by checking if there is content within the input fields etc
 * @param {html} form form with all news info
 * @returns array with bool and string describing if the form has errors(true) or not (false).
 */
function validateForm(form) {
    if(form.content.value === '' || form.content.value.length < 3) 
        return [true, 'Innhold er obligatorisk og må være lengre enn 3 tegn!'];
    return [false, 'success'];
}