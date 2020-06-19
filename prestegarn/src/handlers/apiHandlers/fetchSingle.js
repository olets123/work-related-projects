import { host } from './fetchCtrl.js';

/**
 * Make fetch request to api to fetch a single event information
 * @param {integer} id of event to get
*/
export const fetchSingleEvent = (id) => {
    return Promise.resolve(fetch(`${host}/event/read_single.php?id=${id}`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data;
    }).catch((error) => { console.error(error);}))   
}

/**
 * Make fetch request to api to fetch a single tag information
 * @param {integer} id of tag to get
*/
export const fetchSingleTag = (id) => {
    return Promise.resolve(fetch(`${host}/tags/read_single.php?id=${id}`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}

/**
 * Make fetch request to api to fetch a single tags part of events
 * @param {integer} eId id of event
 * @param {integer} tId id of tag
*/
export const fetchSingleEventHasTag = (eId = null, tId = null) => {
    let fetchUrl = `${host}/eventHasTags/read_single.php?tId=1&eId=1`;
    if (eId != null && tId != null) fetchUrl = `${host}/eventHasTags/read_single.php?eId=${eId}&tId=${tId}`;
    else if (eId == null && tId != null) fetchUrl = `${host}/eventHasTags/read_single.php?tId=${tId}`;
    else if (eId != null && tId == null) fetchUrl = `${host}/eventHasTags/read_single.php?eId=${eId}`;
    return Promise.resolve(fetch(fetchUrl)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}

/**
 * Make fetch request to api to fetch a single friend information
 * @param {integer} id of friend to get
*/
export const fetchSingleFriend = (id) => {
    return Promise.resolve(fetch(`${host}/friends/read_single.php?id=${id}`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}

/**
 * Make fetch request to api to fetch a single friend part of event information
 * @param {integer} eId id of event
 * @param {integer} fId id of friend
*/
export const fetchSingleFriendPartOfEvent = (eId = null, fId = null) => {
    let fetchUrl = `${host}/partof/read_single.php?fId=1&eId=1`;
    if (eId != null && fId != null) fetchUrl = `${host}/partof/read_single.php?eId=${eId}&fId=${fId}`;
    else if (eId == null && fId != null) fetchUrl = `${host}/partof/read_single.php?fId=${fId}`;
    else if (eId != null && fId == null) fetchUrl = `${host}/partof/read_single.php?eId=${eId}`;
    return Promise.resolve(fetch(fetchUrl)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}

/**
 * Make fetch request to api to fetch a single history information
 * @param {integer} id of history to get
*/
export const fetchSingleHistory = (id) => {
    return Promise.resolve(fetch(`${host}/history/read_single.php?id=${id}`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}

/**
 * Make fetch request to api to fetch a single gallery information
 * @param {integer} gId id of gallery
 * @param {integer} tId id of history
*/
export const fetchSingleGallery = (gId = null, tId = null) => {
    let fetchUrl = `${host}/gallery/read_single.php?gId=1&tId=1`;
    if (gId != null && tId != null) fetchUrl = `${host}/gallery/read_single.php?gId=${gId}&tId=${tId}`;
    else if (gId == null && tId != null) fetchUrl = `${host}/gallery/read_single.php?tId=${tId}`;
    else if (gId != null && tId == null) fetchUrl = `${host}/gallery/read_single.php?gId=${gId}`;
    return Promise.resolve(fetch(fetchUrl)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}

/**
 * Make fetch request to api to fetch a single about element information
 * @param {integer} id of about element to get
*/
export const fetchSingleAbout = (id) => {
    return Promise.resolve(fetch(`${host}/about/read_single.php?id=${id}`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}

/**
 * Make fetch request to api to fetch a single news information
 * @param {integer} id of news to get
*/
export const fetchSingleNews = (id) => {
    return Promise.resolve(fetch(`${host}/news/read_single.php?id=${id}`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}

/**
 * Make fetch request to api to fetch a single program information
 * @param {integer} id of program to get
*/
export const fetchSingleProgram = (eId = null, pId = null) => {
    let fetchUrl = `${host}/program/read_single.php?eId=1&pId=1`;
    if (pId != null && eId != null) fetchUrl = `${host}/program/read_single.php?pId=${pId}&eId=${eId}`;
    else if (pId == null && eId != null) fetchUrl = `${host}/program/read_single.php?eId=${eId}`;
    else if (pId != null && eId == null) fetchUrl = `${host}/program/read_single.php?pId=${pId}`;
    return Promise.resolve(fetch(fetchUrl)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}