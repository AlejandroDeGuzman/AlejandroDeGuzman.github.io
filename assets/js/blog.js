var blogCloseButtons = document.querySelectorAll('.blog .closebtn');
if (blogCloseButtons) {
    blogCloseButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            // Remove the closest parent .blog element
            var blogDiv = this.closest('.blog');
            var blogID = blogDiv.querySelector('.BlogID').textContent;

            fetch('deletePost.php', {
                method: 'POST',
                body: JSON.stringify({ id: blogID }),
                headers: { 'Content-Type': 'application/json' }

            })
                .then(response => {
                    if (!response.ok) throw new Error('Delete Failed');
                })

            blogDiv.remove();
        });
    });
}

