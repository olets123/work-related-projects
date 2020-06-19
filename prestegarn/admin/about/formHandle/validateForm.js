/**
 * validates the form by checking if there is content within the input fields etc
 * @param {html} form form with all about info
 * @returns array with bool and string describing if the form has errors(true) or not (false).
 */
function validateForm(form) {
    if(form.hansContent.value === '' || form.hansContent.value.length <= 5) 
        return [true, 'Hans Olavs bio er obligatorisk og må være lengre enn 5 tegn!'];
    if(form.anitaContent.value === '' || form.anitaContent.value.length <= 5) 
        return [true, 'Anitas bio er obligatorisk og må være lengre enn 5 tegn!'];
    if(form.mainContent.value === '' || form.mainContent.value.length <= 5) 
        return [true, 'Hovedinnhold er obligatorisk og må være lengre enn 5 tegn!'];
    if(form.anitaPicture_url.value === '' || form.anitaPicture_url.value.length <= 5) 
        return [true, 'Bilde av Anita er obligatorisk og må ha en link som er lengre enn 5 tegn!'];
    if(form.anitaPicture_alt.value === '' || form.anitaPicture_alt.value.length <= 5) 
        return [true, 'Anitas bildebeskrivelse er obligatorisk og må være lengre enn 5 tegn!'];   
    if(form.hansPicture_url.value === '' || form.hansPicture_url.value.length <= 5) 
        return [true, 'Bilde av Hans Olav er obligatorisk og må ha en link som er lengre enn 5 tegn!'];
    if(form.hansPicture_alt.value === '' || form.hansPicture_alt.value.length <= 5) 
        return [true, 'Hans Olavs bildebeskrivelse er obligatorisk og må være lengre enn 5 tegn!'];   
    if(form.mainPicture_url.value === '' || form.mainPicture_url.value.length <= 5) 
        return [true, 'Hovedbilde er obligatorisk og må ha en link som er lengre enn 5 tegn!'];
    if(form.mainPicture_alt.value === '' || form.mainPicture_alt.value.length <= 5) 
        return [true, 'Hovedbildebeskrivelse er obligatorisk og må være lengre enn 5 tegn!'];   

    return [false, 'success'];
}