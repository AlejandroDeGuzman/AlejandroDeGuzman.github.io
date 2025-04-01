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

// get the corresponding div elements and hide them
function alertplace() {
    var loginSuccessDiv = document.getElementById("login-success");
    if (userDataDiv != null) {
        var innerTags = userDataDiv.getElementsByTagName('p');
        var usernameText = innerTags[0].textContent;
        var loginSuccessText = innerTags[1].textContent;
        console.log(loginSuccessText);
        console.log(usernameText);
        if (loginSuccessText == "1") {
            console.log("revealing element!");
            revealElement(loginSuccessDiv);
        }
    }
}

