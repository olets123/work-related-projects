/**
 * get string and convert it into a date with "." between each value (year, month, and day)
 * @param {string} date to be converted into readable string
*/
export const dateConvert = (date) => {
    let year = date.slice(0, 4);
    let month = date.slice(5, 7);
    let day = date.slice(8, 10);
    let newDate = day + "." + month + "." + year;
    return newDate;
}

/**
 * get string and convert it into a date with "-" between each value (year, month, and day)
 * @param {string} date to be converted into readable string
*/
export const parseableDate = (date) => {
    let year = date.slice(0, 4);
    let month = date.slice(5, 7);
    let day = date.slice(8, 10);
    let newDate = year + "-" + month + "-" + day;
    return newDate;
}

/**
 * Convert string into object for easy retrieval
 * @param {string} date to be converted into object
 */
export const displayDate = (date) => {
    let year = date.slice(0, 4);
    let month = date.slice(5, 7);
    let day = date.slice(8, 10);
    let newDate = new Date(year, month - 1, day);
    
    let textMonth = newDate.toString().slice(4, 7);
    let dateObj = { "day": day, "month": textMonth, "year": year , };
    return dateObj;

}