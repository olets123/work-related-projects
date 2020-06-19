import { fetchCtrl } from './apiHandlers/fetchCtrl.js';
import { fetchNews } from './apiHandlers/fetchAll.js';

/**
 * Create object with fetched news information  
*/
export const getNews = () => {
    return new Promise ((res, rej) => {
        let newsObj = [];
        let newsPromise = fetchCtrl([fetchNews()]);
        newsPromise.then((data) => {
            newsObj = data[0].slice();
            res(newsObj);
        }).catch(error => { rej(() => { throw new Error(error)})});
    })
}