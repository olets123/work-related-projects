/**
 * validates the form by checking if there is content within the input fields etc
 * @param {html} form form with all event info
 * @param {object} gallert obj with history gallery
 * @returns array with bool and string describing if the form has errors(true) or not (false).
 */
function validateForm(form, gallery) {
    console.log(form,)
    let year = getYear();
    if(form.year.value === '' || form.year.value >= year+1)  
        return [true, 'Årstall er obligatorisk og må være i fortiden!'];
    if(form.title.value === '' || form.title.value.length <= 3) 
        return [true, 'Tittel er obligatorisk og må være lengre enn 3 tegn!'];
    if(form.description.value === '' || form.description.value.length <= 5) 
        return [true, 'Beskrivelse er obligatorisk og må være lengre enn 5 tegn!'];
    if(gallery[0].picture_url === '' || gallery[0].picture_alt === '' || gallery.length === 0) 
        return [true, 'Galleri er obligatorisk, og må ha bilde link og bilde tekst !'];
    return [false, 'success'];

}
/**
 * gets the current date
 * @returns the current date
 */
function getYear() {
    return parseInt(new Date().getFullYear());
}
