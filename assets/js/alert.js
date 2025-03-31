function isHidden(elementToCheck) {
    return elementToCheck.OffsetParent === null;
}

function hideElement(elementToCheck) {
    elementToCheck.style.visibility = "hidden";
}

const loginSuccessDiv = document.getElementById("login-success");
if (loginSuccessDiv != null) {
    if (!isHidden(loginSuccessDiv)) {
        hideElement(loginSuccessDiv);
    }
} else {
    console.log("Not on 'login.php' file!");
}


