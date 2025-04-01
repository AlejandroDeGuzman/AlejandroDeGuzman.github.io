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
        console.log(usernameText);
        if (usernameText == "NA") {
            var loginSuccessDiv = document.getElementById("login-fail");
            revealElement(loginSuccessDiv);
        }
    }
}

// using event listeners instead of inline js
var loginSuccess = document.querySelector('#login-success .closebtn');
var loginFail = document.querySelector('#login-fail .closebtn');
var submitLoginButton = document.querySelector('#contact-form-div .form  #submit');
if (loginFail) {
    loginFail.addEventListener('click', function () {
        this.closest('.alert').style.display = 'none';
    })
}

if (loginSuccess) {
    loginSuccess.addEventListener('click', function () {
        this.closest('.alert').style.display = 'none';
    })
}

if (submitLoginButton) {
    submitLoginButton.addEventListener('click', function () {
        alertplace();
    })
}

