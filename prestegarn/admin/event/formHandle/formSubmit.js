/**
 * run when event form is submitted, makes a PUT fetch to update the event in the database
 * @param {event} e on submit event
 * @param {html} form form with all event data
 */
function handleFormUpdate(e, form) {
    e.preventDefault();
    const tags = getTagArr(form.tags.children[0].childNodes, id);
    const friends = getFriendArr(form.friends.elements);
    const program = getProgramArr(form.program.childNodes);
    let error = validateForm(form, tags, friends, program);
    if (error[0] === true) { console.log(error) 
    } else {
        let updateEventObj = [{
            eventId: `${id}`,
            title: form.title.value,
            description: form.description.value,
            date: form.date.value,
            numTickets: form.numTickets.value,
            ticketsSold: form.ticketsSold.value,
            price: form.price.value,
            picture_url: form.picture_url.value,
            picture_alt: form.picture_alt.value
        }, program ]
        console.log(updateEventObj);
        let eventPromise = sendEventObj(updateEventObj[0]);
        eventPromise.then(data => console.log(data));   // show message on page somehow...
        sendProgram(updateEventObj[1]);
    }
}

function handleFormCreate(e, form) {
    e.preventDefault();
    let eId = 0;
    const tags = getTagArr(form.tags.children[0].childNodes, 0);
    const friends = getFriendArr(form.friends.children[0].childNodes);
    const program = getProgramArr(form.program.childNodes);
    console.log(friends);
    let error = validateForm(form, tags, friends, program);
    if (error[0] === true) { console.log(error) 
    } else {
        let createEventObj = [{
            title: form.title.value,
            description: form.description.value,
            date: form.date.value,
            numTickets: form.numTickets.value,
            ticketsSold: form.ticketsSold.value,
            price: form.price.value,
            picture_url: form.picture_url.value,
            picture_alt: form.picture_alt.value
        }, tags, friends, program ];

        let eventPromise = createEvent(createEventObj[0]);
        eventPromise.then(data => {
            eId = data[1];
            createTags(createEventObj[1], eId); createFriends(createEventObj[2], eId); createProgram(createEventObj[3], eId);
        });
    }
}

/**
 * creates array of objects from html input fields
 * @param {html} prog collection of program input fields
 * @returns array of objects with all necessary program information
 */
function getProgramArr(prog) {
    const progArr = [];
    for (let i = 0; i < prog.length; i++) {
        let progDiv = prog[i].childNodes;
        console.log(progDiv);
        if(progDiv[3].attributes.class.nodeValue != 'add') {
            progArr.push({ programId: prog[i].id, time: `${progDiv[0].value} ${progDiv[1].value}`, content: progDiv[2].value });
        }
    }
    console.log(progArr);
    return progArr;
}

/**
 * creates array of objects from html buttons
 * @param {html} tags collection of tag buttons
 * @returns array of objects with all necessary tag information
 */
function getTagArr(tags, id) {
    const tagArr = [];
    for (let i = 0; i < tags.length; i++) {
        if (tags[i].id !== '' && tags[i].id != undefined) {
            let tagContent = tags[i].children[0].textContent != null ? tags[i].children[0].textContent : '';
            tagArr.push({ eventId: id, tagId: tags[i].id, tagContent: tagContent });
        }
    }
    console.log(tagArr);
    return tagArr;
}

/**
 * creates array of objects from html buttons
 * @param {html} friends collection of friend buttons
 * @returns array of objects with all necessary friend information
 */
function getFriendArr(friends) {
    const friendArr = [];
    for (let i = 0; i < friends.length; i++) {
        if (friends[i].id !== '' && friends[i].id !== undefined) {
            
            friendArr.push({friendId: friends[i].id, name: friends[i].textContent});
        }
    }
    console.log(friendArr);
    return friendArr;
}

