document.addEventListener('DOMContentLoaded', function () {
    const wishlist = document.querySelector('.wishlist-btn');
    if (wishlist) {
        wishlist.onclick = () => wishlist.classList.toggle('active');
    }

    document.querySelectorAll('.wishlist-btn').forEach(button => {

        button.addEventListener('click', function () {

            const icon = this.querySelector('i');

            // Toggle heart icon
            if (icon.classList.contains('fa-heart-o')) {
                icon.classList.remove('fa-heart-o');
                icon.classList.add('fa-heart');
                this.classList.add('active');
            } else {
                icon.classList.remove('fa-heart');
                icon.classList.add('fa-heart-o');
                this.classList.remove('active');
            }

        });

    });
});


