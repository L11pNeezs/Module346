document.addEventListener('DOMContentLoaded', function () {
    const formContainer = document.querySelector('#form-container');
    if (!formContainer) return;

    function attachFormHandler() {
        const contributeForm = formContainer.querySelector('form[action="/restaurants/contribute"]');
        if (!contributeForm) return;

        contributeForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(contributeForm);

            fetch(contributeForm.action, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
            })
                .then(response => {
                    const contentType = response.headers.get('Content-Type');
                    if (contentType && contentType.includes('application/json')) {
                        return response.json().then(result => {
                            showModal(result.message)
                            setTimeout(() => {
                                const modal = document.getElementById('response-modal');
                                if (modal) {
                                    modal.style.display = 'none';
                                    if (result.redirect) window.location.href = result.redirect;
                                }
                            }, 1500)
                        });
                    } else {
                        return response.text().then(html => {
                            formContainer.innerHTML = html;
                            attachFormHandler();
                        });
                    }
                })
                .catch(() => {
                });
        });
    }
    attachFormHandler();
});

function showModal(message) {
    const modal = document.getElementById('response-modal');
    const msgSpan = document.getElementById('modal-message');
    if (modal && msgSpan) {
        msgSpan.style.color = 'green';
        msgSpan.textContent = message;
        modal.style.display = 'flex';
    }
}
