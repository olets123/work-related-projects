/**
 * validates the form by checking if there is content within the input fields etc
 * @param {html} form form with all event info
 * @param {object} tags obj with event tags
 * @param {object} friends obj with event friends
 * @param {object} program obj with event program
 * @returns array with bool and string describing if the form has errors(true) or not (false).
 */
function validateForm(form, tags, friends, program) {
    console.log(form,)
    let today = getDate();
    let eventDate = Date.parse(form.date.value);
    if(form.title.value === '' || form.title.value.length <= 3) 
        return [true, 'Tittel er obligatorisk og må være lengre enn 3 tegn!'];
    if(form.description.value === '' || form.description.value.length <= 5) 
        return [true, 'Beskrivelse er obligatorisk og må være lengre enn 5 tegn!'];
    if(form.date.value === '' || eventDate <= today) 
        return [true, 'Dato er obligatorisk og må være etter dags dato'];
    if(form.numTickets.value === '') 
        return [true, 'Bilett antall er obligatorisk!'];
    if(form.picture_url.value === '')
        return [true, 'Bilde link er obligatorisk!'];
    if(form.picture_alt.value === '' || form.picture_alt.value.length <= 5) 
        return [true, 'Bilde beskrivelse er obligatorisk og må være lengre enn 5 tegn!'];
    if(tags[0].tagContent === '' || tags.length === 0) 
        return [true, 'Emneknagg er obligatorisk og må ha flere enn 0 knagger!'];
    if(friends[0].name === '' || friends.length === 0) 
        return [true, 'Venner er obligatorisk og må ha flere enn 0 venner!'];
    if(program[0].content === '' || program.length === 0 || program[0].time.length <= 10) 
        return [true, 'Program er obligatorisk, og må ha tidspunkt og innhold !'];
    return [false, 'success'];

}
/**
 * gets the current date
 * @returns the current date
 */
function getDate() {
    var today = new Date();
    today = Date.parse(today);
    return today;
}
