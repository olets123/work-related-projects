import { host } from './fetchCtrl.js';

/**
 * Make fetch request to api to fetch all events
 * @param {integer} limit how many events to fetch
 * @param {object} sort sorting the fetched events
*/
export const fetchEvents = (limit = null, sort = null) => {
    let fetchUrl = `${host}/event/read.php`;
    if (limit !== null && sort === null) {
        fetchUrl = `${host}/event/read.php?limit=${limit}`;
    } else if (limit !== null && sort !== null) {
        fetchUrl = `${host}/event/read.php?limit=${limit}&sort=1`;
    }
    return Promise.resolve(fetch(fetchUrl))
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);})   
}

/**
 * Make fetch request to api to fetch all tags
*/
export const fetchTags = () => {
    return Promise.resolve(fetch(`${host}/tags/read.php`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}

/**
 * Make fetch request to api to fetch all 'eventHasTags'
*/
export const fetchEventHasTags = () => {
    return Promise.resolve(fetch(`${host}/eventHasTags/read.php`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}
/**
 * Make fetch request to api to fetch all friends
 * @param {integer} limit limiting the friends fetched
*/
export const fetchFriends = (limit = null) => {
    let fetchUrl = `${host}/friends/read.php`;
    if (limit !== null) {
        fetchUrl = `${host}/friends/read.php?limit=${limit}`;
    }
    return Promise.resolve(fetch(fetchUrl)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}
/**
 * Make fetch request to api to fetch all 'friendsPartOfEvents'
*/
export const fetchFriendsPartOfEvents = () => {
    return Promise.resolve(fetch(`${host}/partof/read.php`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}

/**
 * Make fetch request to api to fetch all history elements
 * @param {integer} limit limiting the history elements fetched
*/
export const fetchHistory = (limit = null) => {
    let fetchUrl = `${host}/history/read.php`;
    if (limit !== null) {
        fetchUrl = `${host}/history/read.php?limit=${limit}`;
    }
    return Promise.resolve(fetch(fetchUrl)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}

/**
 * Make fetch request to api to fetch all gallery elements
*/
export const fetchGallery = () => {
    return Promise.resolve(fetch(`${host}/gallery/read.php`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}

/**
 * Make fetch request to api to fetch all about elements
*/
export const fetchAbout = () => {
    return Promise.resolve(fetch(`${host}/about/read.php`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}

/**
 * Make fetch request to api to fetch all news elements
*/
export const fetchNews = () => {
    return Promise.resolve(fetch(`${host}/news/read.php`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}

/**
 * Make fetch request to api to fetch all program elements
*/
export const fetchProgram = () => {
    return Promise.resolve(fetch(`${host}/program/read.php`)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}
