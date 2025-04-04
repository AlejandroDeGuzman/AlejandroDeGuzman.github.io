var blogCloseButtons = document.querySelectorAll('.blog .closebtn');
if (blogCloseButtons) {
    blogCloseButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            // Remove the closest parent .blog element
            this.closest('.blog').remove();
        });
    });
}
