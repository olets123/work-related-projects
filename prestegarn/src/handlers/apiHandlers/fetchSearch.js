import { host } from './fetchCtrl.js';

/**
 * Make fetch request to api to fetch a single event information with certain search parameter
 * @param {string} search parameter to find event element
*/
export const eventSearch = (search) => {
    let fetchUrl = `${host}/event/search.php?search=${search}`;
    return Promise.resolve(fetch(fetchUrl)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}

/**
 * Make fetch request to api to fetch a single tag information with certain search parameter
 * @param {string} search parameter to find tag element
*/
export const tagSearch = (search) => {
    let fetchUrl = `${host}/tags/search.php?search=${search}`;
    return Promise.resolve(fetch(fetchUrl)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}

/**
 * Make fetch request to api to fetch a single history information with certain search parameter
 * @param {string} search parameter to find history element
*/
export const historySearch = (search) => {
    let fetchUrl = `${host}/history/search.php?search=${search}`;
    return Promise.resolve(fetch(fetchUrl)
    .then(response => {
        if(response.ok) return response.json(); 
        throw new Error(response.statusText)})
    .then((data) => {
        return data['data'];
    }).catch((error) => { console.error(error);}))   
}