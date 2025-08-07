document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('open-experience-modal').onclick = function () {
        document.getElementById('experience-modal').style.display = 'flex';
    };

    window.onclick = function (event) {
        var modal = document.getElementById('experience-modal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };
    const stars = document.querySelectorAll('.star-experience');
    const ratingInput = document.getElementById('experience-rating');
    stars.forEach(star => {
        star.addEventListener('click', function () {
            const rating = this.getAttribute('data-star');
            ratingInput.value = rating;
            stars.forEach(s => {
                s.classList.toggle('filled', s.getAttribute('data-star') <= rating);
            });
        });
    })

    document.getElementById('experience-form').onsubmit = function (e) {
        e.preventDefault();
        const errorDiv = document.getElementById('error-restaurant');
        fetch('/restaurants/restaurant-rate', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({
                id: document.getElementById('modal-experience-id').value,
                rating: document.getElementById('experience-rating').value,
                comment: document.getElementById('experience-comment').value
            })
        })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    errorDiv.style.color = 'green';
                    errorDiv.textContent = 'Thank you for your review!';
                    setTimeout(() => {
                        document.getElementById('experience-modal').style.display = 'none';
                        document.getElementById('experience-comment').value = '';
                    }, 1500)
                } else {
                    errorDiv.style.color = 'red';
                    errorDiv.textContent = data.error || 'An error occurred. Please try again.';
                }
            });
    };
    document.getElementById('close-experience-modal').onclick = function () {
        document.getElementById('experience-modal').style.display = 'none';
    };

    document.getElementById('cancel-experience-btn').onclick = function () {
        document.getElementById('experience-modal').style.display = 'none';
    }
});
