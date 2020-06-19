class EventClass {
    constructor(eventObj, friendObj, tagObj) {
        this.eventObj = eventObj;
        this.friendObj = friendObj;
        this.tagObj = tagObj;
        this.isLoaded = false;
        this.newEvent = false;
        this.form = document.getElementById('eventForm');
    }
    
    /**
     * go through objects and array of objects and show information in all fields of the form
     * @param {object} eventObj object with event information 
     * @param {object array} friendObj array of friend objects 
     * @param {object array} tagObj array of tag objects 
    */
    updateForm(all = true) {
        let tagObjToSplice = this.tagObj.slice();
        this.eventObj.tags.forEach(t => {
            this.tagObj.forEach((o, num) => {
                if (o.tagId === t.tagId) {
                    tagObjToSplice.splice(num, 1);
                }
            })
        })
        this.tagObj = tagObjToSplice;
        let friendObjToSplice = this.friendObj.slice();
        this.eventObj.friends.forEach((f) => {
            this.friendObj.forEach((o, num) => {
                if (f.friendId === o.friendId) {
                    friendObjToSplice.splice(num, 1);
                }
            })
        })
        this.friendObj = friendObjToSplice;
        var {
            eventObj,
            friendObj,
            tagObj,
            form
        } = this;
        if (all === true) {
            form.elements.title.value = eventObj.title;
            form.elements.description.value = eventObj.description;
            form.elements.date.value = eventObj.date;
            form.elements.numTickets.value = eventObj.numTickets;
            form.elements.ticketsSold.value = eventObj.ticketsSold;
            form.elements.price.value = eventObj.price;
            form.elements.picture_url.value = eventObj.picture_url;
            form.elements.picture_alt.value = eventObj.picture_alt;
        }
        form.elements.tags.innerHTML = '';

        let tagUl = document.createElement('ul');
        eventObj.tags.forEach(tag => {
            console.log(tag);
            let tagLi = `<li id='${tag.tagId}'><p >${tag.tagContent}</p>
            <button class="remove" id="removeTag" type="button">-</button></li>`
            tagUl.innerHTML += tagLi;
        })
        let emptyLi = '<li><input type="text" id="newTag" placeholder="ny knagg her..."><button id="newTagAdd" class="add"type="button">+</button></li>';
        let tagSelect = `<li><select name="tagSelect" id="tagSelect"><option value=${null} id="0">...</option>`;
        tagObj.forEach(_t => {
            tagSelect += `<option id="${_t.tagId}"" value="${_t.content}">${_t.content}</option>`;
        })
        tagSelect += '</select></li>';
        tagUl.innerHTML += tagSelect + emptyLi +` <li><a href="../tags/tags.php">Se alle knagger</a></li>`;
        form.elements.tags.appendChild(tagUl);

        form.elements.friends.innerHTML = '';
        let friendUl = document.createElement('ul');
        eventObj.friends.forEach(friend => {
            let friendLi = `<li id='${friend.friendId}'><p >${friend.name}</p><button class="remove" id='removeFriend' type="button">-</button></li>`
            friendUl.innerHTML += friendLi;
        });
        let friendSelect = `<li><select name="friendSelect" id="friendSelect"><option value=${null} id="0">...</option>`;
        friendObj.forEach(_f => {
            friendSelect += `<option id="${_f.friendId}"" value="${_f.name}">${_f.name}</option>`;
        });
        friendSelect += '</select></li><li><a href="../friends/friends.php">lag ny venn</a></li>';
        friendUl.innerHTML += friendSelect;
        form.elements.friends.appendChild(friendUl);

        form.elements.program.innerHTML = '';
        eventObj.program.forEach(prog => {
            let date = prog.time.slice(0, 10);
            let time = prog.time.slice(11, prog.time.length);
            let progDiv = document.createElement("div");
            progDiv.innerHTML += `<input type="date" value="${date}"/><input type="time" value="${time}"/><input type="text" value="${prog.content}"/><button type="button" id="removeProg" class="remove">-</button>`;
            progDiv.id = prog.programId;
            form.elements.program.appendChild(progDiv);
        })
        form.elements.program.innerHTML +=  `<div><input type="date" value="${eventObj.date}"/><input type="time"/><input type="text"/><button type="button" id="addProgram" class="add">+</button></div>`

        document.getElementById('tagSelect').addEventListener('change', () => { this.addtag(event); });   
        document.getElementById('friendSelect').addEventListener('change', () => { this.addFriend(event); });  
        document.getElementById('newTagAdd').addEventListener('click', () => { this.createTag(event); });  
        document.getElementById('addProgram').addEventListener('click', () => { this.createProgram(event); });  
        let removeTagBtn = document.querySelectorAll('#removeTag.remove');
        removeTagBtn.forEach((btn) => {
            btn.addEventListener('click', () => { this.removeTag(event); });
        })
        let removeFriend = document.querySelectorAll('#removeFriend.remove');
        removeFriend.forEach((btn) => {
            btn.addEventListener('click', () => { this.removeFriend(event); });
        })
        let removeProgram = document.querySelectorAll('#removeProg.remove');
        removeProgram.forEach((btn) => {
            btn.addEventListener('click', () => { this.removeProgram(event); });
        })
    }

    /**
     * when create tag button is clicked create new tag and send it to the database
     * also add the new tag to the eventObject and tagObj
     * @param {event} e 
    */
    createTag(e) {
        let tagContent = e.target.previousElementSibling.value;
        if (tagContent.length >= 3 && tagContent.length <= 10) {
            let body = JSON.stringify({
                content: tagContent
            })
            fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/tags/create.php`, {
                method: 'POST',
                body: body
            }).then((data) => { 
                if (data.statusText == 'OK') {
                    fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/tags/search.php?search=${tagContent}&admin=true'`, {
                        method: 'GET'
                    }).then((data => data.json())).then((data) => {
                        let eventId = this.eventObj.eventId;
                        console.log(data);
                        let tagId = data.data[0].tagId;
                        console.log(data);
                        let tagBody = JSON.stringify({
                            eventId: eventId,
                            tagId: tagId
                        }); 
                        fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/eventHasTags/create.php`, {
                            method: 'POST',
                            body: tagBody
                        }).then((data) => { 
                            console.log(data.statusText);
                            this.eventObj.tags.push({ eventId: this.eventObj.eventId, tagId: tagId, tagContent: tagContent });
                            this.tagObj.forEach((tag, i) => {
                                if (tag.tagId === tagId) {
                                    this.tagObj.splice(i, 1);
                                }
                            })
                            this.updateForm(false);
                        }).catch((err) => { console.error(err); });
                    })
                }
            }).catch((err) => { console.error(err); });
        }
    }

    /**
     * when add tag button is clicked, add the tag to the eventObject and remove it form the tagObj,
     * update the form and create the connection between event and tag in the database
     * @param {event} e 
    */
    addtag(e) {
        let tagId = e.target.selectedOptions[0].id;
        let tagContent = e.target.selectedOptions[0].value;
        if (tagId !== 0 && tagContent !== 'null') {
            if (this.newEvent === false) {
                let tagBody = JSON.stringify({
                    eventId: this.eventObj.eventId,
                    tagId: tagId
                }); 
                fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/eventHasTags/create.php`, {
                    method: 'POST',
                    body: tagBody
                }).then((data) => { 
                    console.log(data.statusText);
                    this.eventObj.tags.push({ eventId: this.eventObj.eventId, tagId: tagId, tagContent: tagContent});
                    this.tagObj.forEach((tag, i) => {
                        if (tag.tagId === tagId) {
                            this.tagObj.splice(i, 1);
                        }
                    })
                    this.updateForm(false);
                }).catch((err) => { console.error(err); });
            } else {
                let tagForEvent = ({
                    eventId: 'temp',
                    tagId: tagId,
                    tagContent: tagContent
                }); 
                this.eventObj.tags.push(tagForEvent);
                this.tagObj.forEach((tag, i) => {
                    if (tag.tagId === tagId) {
                        this.tagObj.splice(i, 1);
                    }
                })
                this.updateForm(false);
                console.log(this.eventObj);
            }
        }
    }


    /**
     * when remove tag button is clicked, remove the tag from the eventObject and add it to the tagObj, 
     * update the form and remove the connection between event and tag in the database
     * @param {event} e 
     */
    removeTag(e) {
        let tagId = e.target.parentNode.id;
        let eventId = this.eventObj.eventId;
        let tagContent = e.target.previousElementSibling.textContent;
        if (this.newEvent === false) {
            if (tagId !== null && eventId !== null) {
                fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/eventHasTags/delete.php?eId=${eventId}&tId=${tagId}`, {
                    method: 'DELETE'
                }).then((data) => { 
                    console.log(data.statusText);
                    this.eventObj.tags.forEach((tag, i) => {
                        if (tag.tagId === tagId) {
                            this.eventObj.tags.splice(i, 1);
                        }
                    })
                    this.tagObj.push({'tagId': tagId, content: tagContent});
                    this.updateForm(false);
                }).catch((err) => { console.error(err); });
            }
        } else {
            this.eventObj.tags.forEach((tag, i) => {
                if (tag.tagId === tagId) {
                    this.eventObj.tags.splice(i, 1);
                }
            })
            this.tagObj.push({'tagId': tagId, content: tagContent});
            this.updateForm(false);
        }
    }

    /**
     * when add Friend button is clicked, add the Friend to the eventObject and update the form
     * @param {event} e 
     */
    addFriend(e) {
        let friendId = e.target.selectedOptions[0].id;
        let friendContent = e.target.selectedOptions[0].value;
        if (this.newEvent === false) {
            if (friendId !== 0 && friendContent !== 'null') {
                let body = JSON.stringify({
                    eventId: this.eventObj.eventId,
                    friendId: friendId
                }); 
                fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/partof/create.php`, {
                    method: 'POST',
                    body: body
                }).then((data) => { 
                    console.log(data.statusText);
                    this.eventObj.friends.push({eventId: this.eventObj.eventId, friendId: friendId, name: friendContent});
                    this.friendObj.forEach((friend, i) => {
                        if (friend.friendId === friendId) {
                            this.friendObj.splice(i, 1);
                        }
                    })
                    this.updateForm(false);
                }).catch((err) => { console.error(err); });
            }
        } else {
            this.eventObj.friends.push({eventId: this.eventObj.eventId, friendId: friendId, name: friendContent});
            this.friendObj.forEach((friend, i) => {
                if (friend.friendId === friendId) {
                    this.friendObj.splice(i, 1);
                }
            })
            this.updateForm(false);
        }
    }

    /**
     * when remove Friend button is clicked, remove the Friend from the eventObject and update the form
     * @param {event} e 
     */
    removeFriend(e) {
        let friendId = e.target.parentNode.id;
        let eventId = this.eventObj.eventId;
        let friendContent = e.target.previousElementSibling.textContent;
        if (friendId !== null && eventId !== null) {
            fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/partof/delete.php?eId=${eventId}&fId=${friendId}`, {
                method: 'DELETE'
            }).then((data) => { 
                console.log(data.statusText);
                this.eventObj.friends.forEach((friend, i) => {
                    if (friend.friendId === friendId) {
                        this.eventObj.friends.splice(i, 1);
                    }
                })
                this.friendObj.push({ 'friendId': friendId, name: friendContent });
                this.updateForm(false);
            }).catch((err) => { console.error(err); });
        }
    }
    /**
     * when create program button is clicked create new program and send it to the database
     * also add the new program to the eventObject
     * @param {event} e 
    */
    createProgram(e) {
        let programDiv = e.target.parentNode.children;
        let time = programDiv[1].value;
        let date = programDiv[0].value;
        let programContent = programDiv[2].value;
        if (this.newEvent === false) {
            if (programContent.length >= 3 && time.length >= 5 && date.length >= 10) {
                let body = JSON.stringify({
                    eventId: this.eventObj.eventId,
                    time: date + ' ' + time,
                    content: programContent
                });
                fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/program/create.php`, {
                    method: 'POST',
                    body: body
                }).then((data) => {
                    if (data.statusText == 'OK') {
                        fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/program/search.php?search=${programContent}`, {
                            method: 'GET'
                        }).then((data => data.json())).then((data) => {
                            let programId = data.data[0].programId;
                            this.eventObj.program.push({ programId: programId, eventId: this.eventObj.eventId, time: date + ' ' + time, content: programContent });
                            this.updateForm(false);
                        })
                    }
                }).catch((err) => { console.error(err); });
            }
        } else {
            var i = Math.random(0, 10000);
            if (programContent.length >= 3 && time.length >= 5 && date.length >= 10) {
                this.eventObj.program.push({ programId: i, eventId: 'temp', time: date + ' ' + time, content: programContent });
                this.updateForm(false);
            }
        }
    }

    /**
     * when remove Program button is clicked, remove the Program from the eventObject and update the form
     * @param {event} e 
     */
    removeProgram(e) {
        let programId = e.target.parentNode.id;
        if (this.newEvent === false) {
            if (programId != null) {
                fetch(`${host}/2019-IMT2671-GF/app/prestegarn/back-end/api/program/delete.php?id=${programId}`, {
                    method: 'DELETE'
                }).then((data) => { 
                    console.log(data.statusText);
                    this.eventObj.program.forEach((program, i) => {
                        if (program.programId === programId) {
                            this.eventObj.program.splice(i, 1);
                        }
                    })
                    this.updateForm(false);
                }).catch((err) => { console.error(err); });
            } 
        } else {
            console.log(this.eventObj);
            this.eventObj.program.forEach((program, i) => {
                console.log(programId);
                if (program.programId == programId) {
                    console.log("splice");
                    this.eventObj.program.splice(i, 1);
                }
            })
            this.updateForm(false);
        }
    }
}