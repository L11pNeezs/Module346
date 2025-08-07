document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.edit-restaurant-review-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const reviewId = form.dataset.reviewId;
            const formData = new FormData(form);

            fetch('/restaurant_reviews/edit_review', {
                method: 'POST',
                body: formData,
            })
                .then(res => res.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        const reviewDiv = document.getElementById('review-' + reviewId);
                        if (reviewDiv) {
                            reviewDiv.querySelector('.review-rating').textContent = formData.get('rating');
                            reviewDiv.querySelector('.review-comment').textContent = formData.get('comment');
                            form.style.display = 'none';
                            reviewDiv.querySelector('.review-content').style.display = '';
                        }
                    }
                });
        })
    })

    document.querySelectorAll('.cancel-edit').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const reviewId = btn.dataset.reviewId;
            const reviewDiv = document.getElementById('review-' + reviewId);
            if (reviewDiv) {
                reviewDiv.querySelector('.edit-restaurant-review-form').style.display = 'none';
                reviewDiv.querySelector('.review-content').style.display = '';
            }
        });
    });
    document.querySelectorAll('.edit-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const reviewId = btn.dataset.reviewId;
            const reviewDiv = document.getElementById('review-' + reviewId);
            if (reviewDiv) {
                reviewDiv.querySelector('.review-content').style.display = 'none';
                reviewDiv.querySelector('.edit-restaurant-review-form').style.display = '';
            }
        });
    });
});
