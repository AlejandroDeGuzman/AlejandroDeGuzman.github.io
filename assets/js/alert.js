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

var addBlogAlert = document.getElementById("added-blog");

function alertplace() {
    // checking userDataDiv
    if (userDataDiv != null) {
        var innerTags = userDataDiv.getElementsByTagName('p');
        var usernameText = innerTags[0].textContent;
        console.log(usernameText);
        if (usernameText == "NA") {
            var loginFailDiv = document.getElementById("login-fail");
            revealElement(loginFailDiv);
        }
    }

    // check for add blog alert
    if (addBlogAlert != null) {
        revealElement(addBlogAlert);
    }
}

// using event listeners instead of inline js
var loginSuccessCloseButton = document.querySelector('#login-success .closebtn');
var loginFailCloseButton = document.querySelector('#login-fail .closebtn');
var submitLoginButton = document.querySelector('#contact-form-div .form  #submit');
var submitAddPostButton = document.getElementById("submit");
var addBlogAlertCloseButton = document.querySelector('#added-blog .closebtn');

if (addBlogAlertCloseButton) {
    addBlogAlertCloseButton.addEventListener('click', function () {
        this.closest('.alert').style.display = 'none';
    })
}

if (loginFailCloseButton) {
    loginFailCloseButton.addEventListener('click', function () {
        this.closest('.alert').style.display = 'none';
    })
}

if (loginSuccessCloseButton) {
    loginSuccessCloseButton.addEventListener('click', function () {
        this.closest('.alert').style.display = 'none';
        sessionStorage.setItem("loginSuccessClosed", true);
    })
}

if (sessionStorage.getItem("loginSuccessClosed")) {
    var loginSuccessDiv = document.getElementById('login-success');
    if (loginSuccessDiv) {
        loginSuccessDiv.style.display = 'none';
    }
}

if (submitLoginButton) {
    submitLoginButton.addEventListener('click', function () {
        alertplace();
    })
}

if (submitAddPostButton) {
    submitAddPostButton.addEventListener('click', function () {
        alertplace();
    })
}

