document.getElementById('filterForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = e.target;
    const params = new URLSearchParams(new FormData(form)).toString();
    const newUrl = form.action + '?' + params;

    fetch(newUrl, {
        method: 'GET',
        headers: {'X-Requested-With': 'XMLHttpRequest'}
    })
        .then(response => response.text())
        .then(html => {
            console.log(params);
            document.getElementById('restaurantGrid').innerHTML = html;
            initPagination();
            history.replaceState(null, '', newUrl);
        });
});

document.addEventListener('DOMContentLoaded', function () {
    initPagination();
});

function initPagination() {
    const pagination = document.querySelector('.pagination-container');
    const form = document.getElementById('filterForm');
    const pageInput = form.querySelector('[name="page"]');

    form.addEventListener('change', e => {
        pageInput.value = 1;
    })

    pagination.addEventListener('click', function (event) {
        const target = event.target;
        if (target.tagName === 'A' && target.dataset.page) {
            event.preventDefault(); // Prevent default link behavior
            const page = target.dataset.page;
            pageInput.value = page;
            form.dispatchEvent(new Event('submit', { cancelable: true }));}
    });
}

document.addEventListener('DOMContentLoaded', function () {
    initPagination();
});
