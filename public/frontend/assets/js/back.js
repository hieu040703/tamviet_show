document.addEventListener('DOMContentLoaded', function () {
    const ROUTES = window.APP_ROUTES || {};
    const backBtn = document.querySelector('[data-back-button]');
    const btnGoHome = document.querySelector('[data-go-home]');

    if (backBtn) {
        backBtn.addEventListener('click', function () {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = ROUTES.home || '/';
            }
        });
    }

    if (btnGoHome && ROUTES.home) {
        btnGoHome.addEventListener('click', function () {
            window.location.href = ROUTES.home;
        });
    }
});
