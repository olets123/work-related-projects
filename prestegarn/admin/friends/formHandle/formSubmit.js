/**
 * run when event form is submitted, makes a PUT fetch to update the event in the database
 * @param {event} e on submit event
 * @param {html} form form with all event data
 */
function handleFormUpdate(e, form) {
    e.preventDefault();
    let error = validateForm(form);
    if (error[0] === true) { console.log(error) 
    } else {
        let updateFriendObj = {
            friendId: `${id}`,
            name: form.name.value,
            description: form.description.value,
            contact_name: form.contact_name.value,
            contact_phone: form.contact_phone.value,
            email: form.email.value,
            facebookLink: form.facebookLink.value,
            instagramLink: form.instagramLink.value,
            picture_url: form.picture_url.value,
            picture_alt: form.picture_alt.value
        }
        console.log(updateFriendObj);
        let friendPromise = sendFriendObj(updateFriendObj);
        friendPromise.then(data => console.log(data));   // show message on page somehow...
    }
}

function handleFormCreate(e, form) {
    e.preventDefault();
    let error = validateForm(form);
    if (error[0] === true) { console.log(error) 
    } else {
        let createFriendObj = {
            name: form.name.value,
            description: form.description.value,
            contact_name: form.contact_name.value,
            contact_phone: form.contact_phone.value,
            email: form.email.value,
            facebookLink: form.facebookLink.value,
            instagramLink: form.instagramLink.value,
            picture_url: form.picture_url.value,
            picture_alt: form.picture_alt.value
        };
        let eventPromise = createFriend(createFriendObj);
        eventPromise.then(data => {
            console.log(data);
        });
    }
}