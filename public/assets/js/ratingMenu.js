document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.star-rating').forEach(starRating => {
        const stars = starRating.querySelectorAll('.star');
        stars.forEach((star, idx) => {
            star.addEventListener('mouseenter', () => {
                stars.forEach((s, i) => s.classList.toggle('hovered', i <= idx));
            });
            star.addEventListener('mouseleave', () => {
                stars.forEach(s => s.classList.remove('hovered'));
            });
            star.addEventListener('click', () => {
                document.getElementById('modal-menu-id').value = starRating.getAttribute('data-index');
                document.getElementById('modal-rating').value = idx + 1;
                document.getElementById('review-modal').style.display = 'flex';
            });
        });
        starRating.addEventListener('mouseleave', () => {
            stars.forEach(s => s.classList.remove('hovered'));
        });
    });

    document.getElementById('review-form').onsubmit = function (e) {
        e.preventDefault();
        const errorDiv = document.getElementById('error');
        fetch('/restaurants/menu-rate', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({
                id: document.getElementById('modal-menu-id').value,
                rating: document.getElementById('modal-rating').value,
                comment: document.getElementById('modal-comment').value
            })
        })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    errorDiv.style.color = 'green';
                    errorDiv.textContent = 'Thank you for your review!';
                    setTimeout(() => {
                        document.getElementById('review-modal').style.display = 'none';
                        document.getElementById('modal-comment').style.display = 'none';
                    }, 1500);
                } else {
                    errorDiv.style.color = 'red';
                    errorDiv.textContent = data.error || 'An error occurred. Please try again.';
                    }
            });
    };

    document.getElementById('close-modal').onclick = function () {
        document.getElementById('review-modal').style.display = 'none';
    };
});
