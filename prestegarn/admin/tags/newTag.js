
let tObj = getNewObj();
const tagHandler = new TagClass(tObj);
tagHandler.isLoaded = true;
tagHandler.newTag = true;
tagHandler.updateForm();

function getNewObj () {
    let historyObj = { tagId: '', content: '' };
    return historyObj;
}

