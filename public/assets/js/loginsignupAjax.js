document.addEventListener('DOMContentLoaded', function () {
    console.log('Script loaded and DOM ready');
    const signupForm = document.querySelector('form[action="/signup"]');
    if (!signupForm) return;

    if (signupForm) {
        signupForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);

            form.querySelectorAll('input').forEach(input => input.classList.remove('error'));
            form.querySelectorAll('span.error').forEach(span => span.remove());

            const response = await fetch('/signup', {
                method: 'POST',
                body: formData,
                headers: {'X-Requested-With': 'XMLHttpRequest'}
            });

            const result = await response.json();

            form.querySelectorAll('input').forEach(input => input.classList.remove('error'));

            if (result.errors) {
                for (const [field, message] of Object.entries(result.errors)) {
                    const input = form.querySelector(`[name="${field}"]`);
                    if (input) {
                        input.classList.add('error');
                        const errorSpan = document.createElement('span');
                        errorSpan.className = 'error';
                        errorSpan.textContent = message;
                        input.insertAdjacentElement('afterend', errorSpan);
                    }
                }
                document.getElementById('modal-toggle').checked = true;
            } else {
                window.location.reload();
            }
        });
    }
    const loginForm = document.querySelector('form[action="/login"]');
    if (!loginForm) return;

    if (loginForm) {
        loginForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);

            form.querySelectorAll('input').forEach(input => input.classList.remove('error'));
            form.querySelectorAll('span.error').forEach(span => span.remove());

            const response = await fetch('/login', {
                method: 'POST',
                body: formData,
                headers: {'X-Requested-With': 'XMLHttpRequest'}
            });

            const result = await response.json();

            form.querySelectorAll('input').forEach(input => input.classList.remove('error'));

            if (result.errors) {
                for (const [field, message] of Object.entries(result.errors)) {
                    const input = form.querySelector(`[name="${field}"]`);
                    if (input) {
                        input.classList.add('error');
                        const errorSpan = document.createElement('span');
                        errorSpan.className = 'error';
                        errorSpan.textContent = message;
                        input.insertAdjacentElement('afterend', errorSpan);
                    }
                }
                document.getElementById('modal-toggle').checked = true;
            } else {
                window.location.reload();
            }
        });
    }
});
