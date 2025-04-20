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

// add event listeners for all the alert close buttons...
var loginSuccessCloseButton = document.querySelector('#login-success .closebtn');
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

var loginFailCloseButton = document.querySelector('#login-fail .closebtn');
if (loginFailCloseButton) {
    loginFailCloseButton.addEventListener('click', function () {
        this.closest('.alert').style.display = 'none';
    })
}

var addBlogAlertCloseButton = document.querySelector('#added-blog .closebtn');
if (addBlogAlertCloseButton) {
    addBlogAlertCloseButton.addEventListener('click', function () {
        this.closest('.alert').style.display = 'none';

        // Send background request to PHP to update session
        fetch('dismissAddBlogAlert.php', {
            method: 'POST',
            credentials: 'same-origin' // ensures session cookies are sent
        });
    })
}
