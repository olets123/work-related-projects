
let hObj = getNewObj();
const historyHandler = new HistoryClass(hObj);
historyHandler.isLoaded = true;
historyHandler.newHistory = true;
historyHandler.updateForm();

function getNewObj () {
    let historyObj = { timeId: '', title: '', description: '', pictures: [] };
    return historyObj;
}

