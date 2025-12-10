document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('load-more');
    if (!btn) return;

    btn.addEventListener('click', function () {
        const page = parseInt(btn.dataset.page);
        const url = btn.dataset.url;
        const params = new URLSearchParams(window.location.search);
        params.set('page', page);

        fetch(url + '?' + params.toString(), {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(res => res.json())
            .then(data => {
                document.getElementById('post-list').insertAdjacentHTML('beforeend', data.html);

                if (data.hasMore) {
                    btn.dataset.page = page + 1;
                } else {
                    btn.remove();
                }
            });
    });
});
