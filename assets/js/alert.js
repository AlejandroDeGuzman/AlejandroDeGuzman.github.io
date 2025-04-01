function isHidden(elementToCheck) {
    return elementToCheck.OffsetParent === null;
}

function hideElement(elementToCheck) {
    if (elementToCheck != null) {
        elementToCheck.style.display = "none";
    }
}

function revealElement(elementToCheck) {
    if (elementToCheck != null) {
        elementToCheck.style.display = "flex";
    }
}

var userDataDiv = document.getElementById("user-data");
hideElement(userDataDiv);

function alertplace() {
    if (userDataDiv != null) {
        var innerTags = userDataDiv.getElementsByTagName('p');
        var usernameText = innerTags[0].textContent;
        var loginSuccessText = innerTags[1].textContent;
        console.log(loginSuccessText);
        console.log(usernameText);
        if (loginSuccessText == "1") {
            var loginSuccessDiv = document.getElementById("login-success");
            revealElement(loginSuccessDiv);
        } else if (usernameText == "NA") {
            var loginSuccessDiv = document.getElementById("login-fail");
            revealElement(loginSuccessDiv);
        }
    }
}
