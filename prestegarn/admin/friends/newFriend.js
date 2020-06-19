let fObj = getNewObj();
console.log(fObj);
const friendHandler = new FriendClass(fObj);
friendHandler.isLoaded = true;
friendHandler.newFriend = true;
friendHandler.updateForm();

function getNewObj () {
    let friendObj = [];
    friendObj = { friendId: '', name: '', description: '', contact_name: '',
        contact_phone: '', email: '', facebookLink: '', instagramLink: '', 
        picture_url: '', picture_alt: ''};
    return friendObj;
}