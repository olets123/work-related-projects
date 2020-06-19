/**
 * validates the form by checking if there is content within the input fields etc
 * @param {html} form form with all friend info
 * @returns array with bool and string describing if the form has errors(true) or not (false).
 */
function validateForm(form) {
    console.log(form,)

    if(form.name.value === '' || form.name.value.length <= 3) 
        return [true, 'Navn er obligatorisk og må være lengre enn 3 tegn!'];
    if(form.description.value === '' || form.description.value.length <= 5) 
        return [true, 'Beskrivelse er obligatorisk og må være lengre enn 5 tegn!'];
    if(form.contact_name.value === '' || form.contact_name.value.length <= 3) 
        return [true, 'Kontaktperson er obligatorisk og må være lengre enn 3 tegn!'];
    if(form.picture_url.value === '')
        return [true, 'Bilde link er obligatorisk!'];
    if(form.picture_alt.value === '' || form.picture_alt.value.length <= 5) 
        return [true, 'Bilde beskrivelse er obligatorisk og må være lengre enn 5 tegn!'];
    return [false, 'success'];

}
