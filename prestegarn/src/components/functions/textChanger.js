
/**
 * if the text is longer than the length add ... to the end of it
 * @param {string} str to be snipped
 * @param {integer} length how long can the string be
*/
export const snipText = (str, length) => {
    const ending = "...";
    return str.substring(0, length - ending.length) + ending;
}

/**
 * Creates array of shorter strings to improve readability of text
 * @param {string} str long text to be broken into smaller texts
 * @param {int} length how long is the text to be
 * @returns array of strings
 */
export const lineBreaker = (str, length) => {
    let tempString = str;
    let strings = [];
    let prevLength = 0;
    for(let v = 0; v<tempString.length; v++ ) {
        if (( v >= prevLength + length) && (tempString[v] === '.' )) {
            if (prevLength === 0) {
                strings.push(tempString.substring(prevLength, v+2));
            } else {
                strings.push(tempString.substring(prevLength+2, v+2));
            }
            prevLength = v;
        }
    }
    return strings;
}