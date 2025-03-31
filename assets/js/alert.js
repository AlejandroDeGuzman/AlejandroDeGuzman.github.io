function isHidden(elementToCheck) {
    return elementToCheck.OffsetParent === null;
}

function hideElement(elementToCheck) {
    if (elementToCheck != null) {
        elementToCheck.style.display = "none";
    }
}

var loginSuccessDiv = document.getElementById("login-success");
hideElement(loginSuccessDiv);
var userDataDiv = document.getElementById("user-data");
// hideElement(userDataDiv);
// const username = userDataDiv.dataset.username;
// const loginSuccess = userDataDiv.dataset.loginSuccess === 'true'; // Convert to boolean
// console.log("Username: " + username);
// console.log("User Logged In? " + loginSuccess);

// get the corresponding div elements and hide them
function alertplace() {
    if (userDataDiv != null) {
        console.log(userDataDiv.innerHTML);
        //     const username = userDataDiv.dataset.username;
        //     const loginSuccess = userDataDiv.dataset.loginSuccess == '1'; // Convert to boolean
        //     console.log("Username: " + username);
        //     console.log("User Logged In? " + loginSuccess);
    }
}

