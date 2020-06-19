import { host } from './apiHandlers/fetchCtrl.js';

/**
 * creates new row in the reservation table
 * @param {object} formData data with all form information
 * @returns promise with array of either true or false depending on if the row was created
*/
export const createReservation = (formData) => {
    let jsonObj = JSON.stringify(formData);
    return new Promise((res, rej) => {
        fetch(`${host}/reservation/create.php`, {
            method: 'POST',
            body: jsonObj
        }).then(data => {
            res([true, 'reservasjon lagd'])
        }).catch(err => {
            rej([false, err]);
        })
    })
}

