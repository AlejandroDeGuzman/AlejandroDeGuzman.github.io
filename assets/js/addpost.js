var submitButton = document.getElementById("submit");
if (submitButton) {
    submitButton.addEventListener("click", function (e) {
        var titleFieldInput = document.getElementById("title");
        var messageBlogFieldInput = document.getElementById("message");
        if (titleFieldInput) {
            let valid = true;
            var input = titleFieldInput.value;
            if (input === "") {
                titleFieldInput.classList.add("input-error");
                valid = false;
            }

            if (!valid) {
                e.preventDefault();
                setTimeout(() => {
                    titleFieldInput.classList.remove("input-error");
                }, 2000);
            }
        }

        if (messageBlogFieldInput) {
            let valid = true;
            var input = messageBlogFieldInput.value;
            if (input === "") {
                messageBlogFieldInput.classList.add("input-error");
                valid = false;
            }

            if (!valid) {
                e.preventDefault();
                setTimeout(() => {
                    messageBlogFieldInput.classList.remove("input-error");
                }, 2000);
            }
        }
    });
}

